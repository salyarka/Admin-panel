<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTopic;
use App\Http\Requests\EditTopic;
use Illuminate\Http\Request;
use App\Topic;
use App\Services\Log;


class FaqController extends Controller
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
     * Check that request is from admin.
     * 
     * @param  Request  $request
     * @return boolean 
     */
    public function isAdminRequest(Request $request)
    {
        return ($request->route()->getPrefix() == 'admin/faq');
    }

    /**
     * Display a faq with answered questions.
     *
     * @param  Request $request
     * @return Response
     **/
    public function show(Request $request)
    {
        // dd($request->route()->getPrefix());
        $topics = Topic::all();
        $view = $this->isAdminRequest($request) ? 'dashboard.faq' : 'faq';
        return view($view, ['topics' => $topics]);
    }

    /**
     * Adds topic.
     * 
     * @param Addtopic $request
     * @return Response
     */
    public function add(AddTopic $request)
    {
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->save();
        flash('Тема успешно добавлена.', 'success');
        $this->myLog->write(
            'создал тему "' .
            $topic->title .
            '" (' . $topic->id . ')'
        );
        return redirect()->back();
    }

    /**
     * Edit topic.
     * 
     * @param  EditTopic $request 
     * @param  string    $id      topics id
     * @return Response             
     */
    public function edit(EditTopic $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->title = $request->new_title;
        $topic->save();
        flash('Тема успешно изменена.', 'success');
        $this->myLog->write(
            'изменил тему "' .
            $topic->title .
            '" (' . $topic->id . ')'
        );
        return redirect()->back();
    }

    /**
     * Delete topic.
     * 
     * @param  string $id topics id
     * @return Response
     */
    public function delete($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        flash('Тема успешно удалена.', 'success');
        $this->myLog->write(
            'удалил тему "' .
            $topic->title .
            '" (' . $topic->id . ')'
        );
        return redirect()->back();
    }
}
