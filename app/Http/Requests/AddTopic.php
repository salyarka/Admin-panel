<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTopic extends FormRequest
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
            'title' => 'required|unique:topics|max:50|alpha_num'
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
            'title.required' => 'Тема обязательна для заполнения.',
            'title.unique' => 'Такая тема уже существует.',
            'title.max' => 'Слишком длинное название.',
            'title.alpha_num' => 'Название темы может содержать буквы и цифры.'
        ];
    }
}
