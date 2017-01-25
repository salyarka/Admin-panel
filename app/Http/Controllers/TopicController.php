<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class TopicController extends Controller
{
    /**
     * [show description]
     * 
     * @return [type] [description]
     */
    public function show(Request $request, $id)
    {
        $questions = Question::where('topic_id', '=', $id)->get();
        return view('topic', ['questions' => $questions]);
    }

    /**
     * 
     * @return [type] [description]
     */
    public function add()
    {

    }

    /**
     * [edit description]
     * 
     * @return [type] [description]
     */
    public function edit(Request $request, $id)
    {
        $question = Question::find($id);
    }

    /**
     * [delete description]
     * 
     * @return [type] [description]
     */
    public function delete(Request $request, $id)
    {
        $question = Question::find($id);
    }
}
