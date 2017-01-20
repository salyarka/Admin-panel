<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAdmin extends FormRequest
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
        $id = $this->route('id');
        return [
            'new_login' => 'required|max:25|unique:admins,login,' . $id,
            'new_surname' => 'required|max:25',
            'new_name' => 'required|max:25',
            'new_password' => 'min:6|confirmed',
            'new_password_confirmation' => 'min:6'            
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
            'new_login.unique' => 'Такой логин уже существует.',
            'new_login.max'  => 'Слишком длинный логин.',
            'new_surname.max'  => 'Фамилия слишком длинная.',
            'new_name.max'  => 'Слишком длинное имя.',
            'new_password.confirmed' => 'Пароль не совпадает с подтверждением.',
            'new_password.min' => 'Пароль должен содержать минимум 6 символов.',
            'new_password_confirmation.min' => 'Пароль не совпадает с подтверждением.'
        ];
    }
}
