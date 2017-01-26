<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditQuestion;
use Illuminate\Http\Request;
use App\Question;

class TopicController extends Controller
{
    /**
     * [show description]
     * 
     * @return [type] [description]
     */
    public function show($id)
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
    public function edit(EditQuestion $request, $question_id)
    {
        $question = Question::find($question_id);
        $question->text = $request->new_text;
        if ($request->new_answer) {
            $question->answer = $request->new_answer;
        } else {
            $question->answer = NULL;
        }
        $question->author_name = $request->new_author_name;
        $question->save();
        flash('Вопрос успешно изменен.', 'success');
        return redirect()->back();
    }

    /**
     * [delete description]
     * 
     * @return [type] [description]
     */
    public function delete($question_id)
    {
        $question = Question::find($question_id);
        $question->delete();
        flash('Вопрос успешно удален.', 'success');
        return redirect()->back();
    }

    public function hide($question_id)
    {
        $question = Question::find($question_id);
        if ($question->status == 0) {
            $question->status = 1;
        } else {
            $question->status = 0;
        }
        $question->save();
        return redirect()->back();        
    }
}
