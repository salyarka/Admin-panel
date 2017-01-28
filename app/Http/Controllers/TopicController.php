<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerQuestion;
use App\Http\Requests\EditQuestion;
use Illuminate\Http\Request;
use App\Question;
use App\Topic;
use App\Log\Log;


class TopicController extends Controller
{
    private $myLog;

    public function __construct(Log $log)
    {
        $this->myLog = $log;
    }


    /**
     * [show description]
     * 
     * @return [type] [description]
     */
    public function show($id)
    {
        $questions = Question::where('topic_id', '=', $id)->get();
        $topics = Topic::all();
        return view('dashboard.topic', ['questions' => $questions, 'topics' => $topics]);
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
        $question->topic_id = $request->new_topic;
        $question->author_name = $request->new_author_name;
        $question->save();
        $this->myLog->write();
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

    /**
     * [hide description]
     * 
     * @param  [type] $question_id [description]
     * @return [type]              [description]
     */
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

    /**
     * [answer description]
     * 
     * @param  [type] $question_id [description]
     * @return [type]              [description]
     */
    public function answer(AnswerQuestion $request, $question_id)
    {
        $question = Question::find($question_id);
        if (!$question->answer) {
            $question->answer = $request->answer;
            if ($request->with_publication == 1) {
                $question->status = 1;
            }
            $question->save();
            return redirect()->back();
        }
    }

    /**
     * [showUnAnswered description]
     * 
     * @return [type] [description]
     */
    public function showUnAnswered()
    {
        $questions = Question::whereNull('answer')->orderBy('id')->get();
        $topics = Topic::all();
        return view('dashboard.unanswered_questions', ['questions' => $questions, 'topics' => $topics]);
    }
}
