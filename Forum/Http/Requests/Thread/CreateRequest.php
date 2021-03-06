<?php

namespace Bitaac\Forum\Http\Requests\Thread;

use Bitaac\Core\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'title'   => ['required', 'between:3,60', 'forum_title'],
            'author'  => ['required', 'owns_character'],
            'content' => ['required', 'between:15,3000'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function authorize()
    {
        return true;
    }
}
