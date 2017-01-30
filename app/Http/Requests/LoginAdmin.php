<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'login.required' => 'Логин обязателен для заполнения.',
            'password.required' => 'Пароль обязателен для заполнения.'
        ];
    }
}