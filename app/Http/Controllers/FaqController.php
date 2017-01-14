<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Question;


class FaqController extends Controller
{
    /**
     * Display a faq with answered questions
     *
     * @param  Request  $request
     * @return Response
     **/
    public function __invoke(Request $request)
    {
        $topics = Topic::all();
        $questions = Topic::answeredQuestions();
        return view('faq', ['topics' => $topics,'questions' => $questions]);
    }
}
