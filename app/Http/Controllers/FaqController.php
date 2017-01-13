<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class FaqController extends Controller
{
    public function __invoke(Request $request)
    {
        // REMAKE
        $topics = Topic::all();
        // $questions = Topic::with()->questions;
        $answered = Topic::find(1)->questions()->whereNotNull('answer')->get();
        // $answered = Topic::find(1)->answered();
        $unAnswered = Topic::find(1)->questions()->whereNull('answer')->get(); 
        // $topic->Topicquestions()->whereNotNull('answer');
        return view('faq', ['topics' => $topics, 'answered' => $answered, 'unAnswered' => $unAnswered
                            ]);
    }
}
