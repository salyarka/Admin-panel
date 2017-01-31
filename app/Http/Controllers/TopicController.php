<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerQuestion;
use App\Http\Requests\StoreQuestion;
use App\Http\Requests\EditQuestion;
use App\Question;
use App\Topic;
use App\Forbidden;
use App\Services\Log;


class TopicController extends Controller
{
    /**
     * Log instance.
     * 
     * @var Log
     */    
    private $myLog;

    /**
     * Create a new controller instance.
     * 
     * @param Log $log
     * @return  void
     */
    public function __construct(Log $log)
    {
        $this->myLog = $log;
    }


    /**
     * Show questions in topic.
     *
     * @param  string   $id  topics id
     * @return Response
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        $topics = Topic::all();
        return view('dashboard.topic', ['topics' => $topics, 'topic' => $topic]);
    }

    /**
     * Add new question from user.
     *
     * @param  StoreQuestion $request 
     * @return Response
     */
    public function add(StoreQuestion $request)
    {
        $question = new Question();
        $question->text = $request->text;
        $question->check();
        $question->author_name = $request->author_name;
        $question->topic_id = $request->topic_id;
        $question->save();
        flash(
            'Ваш вопрос отправлен,
            после того как он пройдет обработку,
            он будет опубликован в разделe FAQ', 'success'
        );
        return redirect()->back();        
    }

    /**
     * Edit question.
     *
     * @param  EditQuestion $request 
     * @param  string       $question_id   
     * @return Response
     */
    public function edit(EditQuestion $request, $question_id)
    {
        $question = Question::findOrFail($question_id);
        $question->text = $request->new_text;
        $question->check();
        if ($request->new_answer) {
            $question->answer = $request->new_answer;
        } else {
            $question->answer = NULL;
        }
        $question->topic_id = $request->new_topic;
        $question->author_name = $request->new_author_name;
        $question->save();
        flash('Вопрос успешно изменен.', 'success');
        $this->myLog->write(
            'обновил вопрос (' .
            $question->id .
            ') из темы "' .
            $question->topic->title .
            '" (' . $question->topic->id . ')'
        );
        return redirect()->back();
    }

    /**
     * Delete question.
     *
     * @param  string       $question_id 
     * @return Response
     */
    public function delete($question_id)
    {
        $question = Question::findOrFail($question_id);
        $question->delete();
        flash('Вопрос успешно удален.', 'success');
        $this->myLog->write(
            'удалил вопрос (' .
            $question->id .
            ') из темы "' .
            $question->topic->title .
            '" (' . $question->topic->id . ')'
        );
        return redirect()->back();
    }

    /**
     * Hide question.
     * 
     * @param  string   $question_id 
     * @return Response
     */
    public function hide($question_id)
    {
        $question = Question::findOrFail($question_id);
        if ($question->status == 0) {
            $question->status = 1;
            $this->myLog->write(
                'сделал вопрос (' .
                $question->id .
                ') открытым из темы "' .
                $question->topic->title .
                '" (' . $question->topic->id . ')'
            );
        } else {
            $question->status = 0;
            $this->myLog->write(
                'скрыл вопрос (' .
                $question->id .
                ') из темы "' .
                $question->topic->title .
                '" (' . $question->topic->id . ')'
            );
        }
        $question->save();
        return redirect()->back();        
    }

    /**
     * Answer question.
     * 
     * @param  AnswerQuestion $request
     * @param  string         $question_id
     * @return Response
     */
    public function answer(AnswerQuestion $request, $question_id)
    {
        $question = Question::findOrFail($question_id);
        if (!$question->answer) {
            $question->answer = $request->answer;
            if ($request->with_publication == 1) {
                $question->status = 1;
                $this->myLog->write(
                    'ответил на вопрос (' .
                    $question->id .
                    ') из темы "' .
                    $question->topic->title .
                    '" (' . $question->topic->id .
                    ') с публикацией'
                );
            } else{
                $this->myLog->write(
                    'ответил на вопрос (' .
                    $question->id .
                    ') из темы "' .
                    $question->topic->title .
                    '" (' . $question->topic->id .
                    ') с скрытием'
                );
            }
            $question->save();
            return redirect()->back();
        }
    }

    /**
     * Shows unanswered questions.
     * 
     * @return Response
     */
    public function showUnAnswered()
    {
        $questions = Question::whereNull('answer')->orderBy('id')->get();
        $topics = Topic::all();
        return view(
            'dashboard.unanswered_questions',
            ['questions' => $questions, 'topics' => $topics]
        );
    }

    /**
     * Shows blockes questions.
     * 
     * @return Response
     */
    public function showBlocked()
    {
        $questions = Question::where('status', 2)->get();
        $topics = Topic::all();
        $forbiddens = Forbidden::all();
        return view(
            'dashboard.blocked_questions',
            [
                'questions' => $questions,
                'topics' => $topics,
                'forbiddens' => $forbiddens
            ]
        );
    }
}
