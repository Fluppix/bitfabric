<?php

namespace Bitaac\Account\Http\Requests\Change;

use Response;
use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest {
    public function rules()
    {
        return [
            'email'    => 'required|email|unique:accounts,email',
            'password' => 'required' 
        ];
    }

    public function authorize()
    {
        return true;
    }
}
