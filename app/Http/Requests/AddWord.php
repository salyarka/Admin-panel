<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddWord extends FormRequest
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
            'word' => 'required|unique:forbiddens'
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
            'word.required' => 'Слово обязательно для заполнения.',
            'word.unique' => 'Такое запрещенное слово уже есть.'            
        ];
    }
}
