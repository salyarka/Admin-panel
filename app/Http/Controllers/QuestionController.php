<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Question;

class QuestionController extends Controller
{
    public function __invoke(StoreQuestion $request)
    {
        $question = new Question();
        $question->text = $request->text;
        $question->status = 0;
        $question->author_name = $request->author_name;
        $question->topic_id = $request->topic_id;
        $question->save();
        flash('Ваш вопрос отправлен, после того как он пройдет обработку, он будет опубликован в разделe FAQ', 'success');
        return redirect('faq');
    }
}
