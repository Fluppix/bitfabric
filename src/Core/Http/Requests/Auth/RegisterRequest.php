<?php

namespace Bitaac\Core\Http\Requests\Auth;

use Response;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    public function rules()
    {
        return [
            'account'  => 'required|between:4,23|alpha_num|unique:accounts,name',
            'email'    => 'required|email|unique:accounts,email',
            'password' => 'required|confirmed|min:6',
            'terms'    => 'accepted' 
        ];
    }

    public function authorize()
    {
        return true;
    }
}
