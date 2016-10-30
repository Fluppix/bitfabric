<?php

namespace Bitaac\Core\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'account'  => ['required'],
            'password' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
