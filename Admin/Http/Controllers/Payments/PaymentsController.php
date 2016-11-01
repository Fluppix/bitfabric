<?php

namespace Bitaac\Admin\Http\Controllers\Payments;

use Bitaac\Store\Models\Payment;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Products\CreateRequest;

class PaymentsController extends Controller
{
    /**
     * Show all payments to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Payment $payment)
    {
        return view('admin::store.payments.show')->with([
            'payments' => $payment->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
