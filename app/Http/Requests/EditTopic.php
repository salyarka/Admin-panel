<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTopic extends FormRequest
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
            'new_title' => 'required|max:50|alpha_num|unique:topics,title,' . $id
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
            'new_title.required' => 'Тема обязательна для заполнения.',
            'new_title.unique' => 'Такая тема уже существует.',
            'new_title.max' => 'Слишком длинное название.',
            'new_title.alpha_num' => 'Название темы может содержать буквы и цифры.'
        ];
    }
}
