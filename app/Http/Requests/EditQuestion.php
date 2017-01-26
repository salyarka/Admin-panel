<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditQuestion extends FormRequest
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
        $question_id = $this->route('question_id');
        return [
            'new_text' => 'required|unique:questions,text,' . $question_id,
            'new_author_name' => 'required|max:50|alpha|'
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
            'new_text.required' => 'Текст вопроса обязателен.',
            'new_text.unique' => 'Такой вопрос цже существует.',
            'new_author_name.required' => 'У вопроса обязательно должен быть автор.',
            'new_author_name.max' => 'Слишком длинное имя.',
            'new_author_name.alpha' => 'Имя автора может содержать только буквы.'
        ];
    }
}
