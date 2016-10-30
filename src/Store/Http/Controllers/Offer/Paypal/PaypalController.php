<?php

namespace Bitaac\Store\Http\Controllers\Offer\Paypal;

use Paytal;
use Illuminate\Http\Request;
use Bitaac\Store\Models\Payment;
use App\Http\Controllers\Controller;

class PaypalController extends Controller
{
    /**
     * Show the paypal offers to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bitaac::store.offers.paypal.index');
    }

    /**
     * Create & Process the payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        // Verify that the amount exists as a offer.
        if (! isset(config('bitaac.paytal.paypal.offers')[$request->get('amount')])) {
            return back()->withErrors('Something went wrong, please try again.');
        }

        $gateway = Paytal::create('paypal.rest');

        $config = (object) config('bitaac.paytal.paypal.auth');

        $gateway->authorize([
            'client'    => $config->client,
            'secret'    => $config->secret,
            'returnUrl' => route($config->returnUrl),
            'cancelUrl' => route($config->cancelUrl),
        ]);

        $gateway->purchase([
            'amount'   => $request->get('amount'),
            'currency' => config('bitaac.paytal.paypal.currency'),
            'custom'   => auth()->id(),
            'name'     => 'Donation Points',
        ]);

        return $gateway->redirect();
    }

    /**
     * Complete the payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function return(Request $request)
    {
        // Init a new paytal object, and authorize to choosen
        // payment gateway.
        $gateway = Paytal::create('paypal.rest');

        $config = (object) config('bitaac.paytal.paypal.auth');

        $gateway->authorize([
            'client' => $config->client,
            'secret' => $config->secret,
        ]);

        // Complete/get the payment
        $response = $gateway->completePayment($request->all());

        $payment = Payment::where(function ($query) use ($response) {
            $query->where('payment_id', $response->payment->parent_payment);
            $query->where('method', 'paypal');
        });

        if (! $response->isCompleted() && $payment->exists()) {
            dd('Payment was not completed.');
        }

        $payment = new Payment;
        $payment->payment_id = $response->payment->parent_payment;
        $payment->method = 'paypal';
        $payment->currency = $response->payment->amount->currency;
        $payment->amount = $response->payment->amount->total;
        $payment->account_id = $response->payment->custom;
        $payment->points = config('bitaac.paytal.paypal.offers')[$response->payment->amount->total];
        $payment->save();

        $user = auth()->user()->bit;
        $user->points = $user->points + $payment->points;
        $user->save();

        return redirect('/store')->withSuccess("Thanks for your purchase, {$payment->points} points has been added to your account.");
    }
}
