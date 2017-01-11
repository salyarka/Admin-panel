<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __invoke(Request $request)
    {
        /**
         * Под вопросом, правильно или нет
         */
        $this->validate($request, [
            'name' => 'required|max:255' ,
            'email' => '',
            'question' => ''
        ]);
    }
}
