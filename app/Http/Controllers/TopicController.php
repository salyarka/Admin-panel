<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerQuestion;
use App\Http\Requests\EditQuestion;
use Illuminate\Http\Request;
use App\Question;
use App\Topic;
use App\Services\Log;
use App\Services\Overseer;


class TopicController extends Controller
{
    private $myLog;
    private $myOverseer;

    public function __construct(Log $log, Overseer $overseer)
    {
        $this->myLog = $log;
        $this->myOverseer = $overseer;
    }


    /**
     * [show description]
     * 
     * @return [type] [description]
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        $topics = Topic::all();
        return view('dashboard.topic', ['topics' => $topics, 'topic' => $topic]);
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
        $question = Question::findOrFail($question_id);
        $question->text = $request->new_text;
        $this->myOverseer->check($question);
        if ($request->new_answer) {
            $question->answer = $request->new_answer;
        } else {
            $question->answer = NULL;
        }
        $question->topic_id = $request->new_topic;
        $question->author_name = $request->new_author_name;
        $question->save();
        flash('Вопрос успешно изменен.', 'success');
        $this->myLog->write('обновил вопрос (' . $question->id . ') из темы "' . $question->topic->title . '" (' . $question->topic->id . ')');
        return redirect()->back();
    }

    /**
     * [delete description]
     * 
     * @return [type] [description]
     */
    public function delete($question_id)
    {
        $question = Question::findOrFail($question_id);
        $question->delete();
        flash('Вопрос успешно удален.', 'success');
        $this->myLog->write('удалил вопрос (' . $question->id . ') из темы "' . $question->topic->title . '" (' . $question->topic->id . ')');
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
        $question = Question::findOrFail($question_id);
        if ($question->status == 0) {
            $question->status = 1;
            $this->myLog->write('сделал вопрос (' . $question->id . ') открытым из темы "' . $question->topic->title . '" (' . $question->topic->id . ')');
        } else {
            $question->status = 0;
            $this->myLog->write('скрыл вопрос (' . $question->id . ') из темы "' . $question->topic->title . '" (' . $question->topic->id . ')');
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
        $question = Question::findOrFail($question_id);
        if (!$question->answer) {
            $question->answer = $request->answer;
            if ($request->with_publication == 1) {
                $question->status = 1;
            $this->myLog->write('ответил на вопрос (' . $question->id . ') из темы "' . $question->topic->title . '" (' . $question->topic->id . ') с публикацией');

            } else{
                $this->myLog->write('ответил на вопрос (' . $question->id . ') из темы "' . $question->topic->title . '" (' . $question->topic->id . ') с скрытием');
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

    /**
     * [blocked description]
     * 
     * @return [type] [description]
     */
    public function blocked()
    {
        $questions = Question::whereNotNull('alert_words')->get();
        $topics = Topic::all();
        return view('dashboard.blocked_questions', ['questions' => $questions, 'topics' => $topics]);
    }

}
