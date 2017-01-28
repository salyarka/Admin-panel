<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTopic;
use App\Http\Requests\EditTopic;
use Illuminate\Http\Request;
use App\Question;
use App\Topic;


class FaqController extends Controller
{
    /**
     * [isAdminRequest description]
     * @return boolean [description]
     */
    public function isAdminRequest(Request $request)
    {
        return ($request->route()->getPrefix() == 'admin/faq');
    }

    /**
     * Display a faq with answered questions
     *
     * @param  Request  $request
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
     * [add description]
     * 
     * @param Request $request [description]
     */
    public function add(AddTopic $request)
    {
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->save();
        flash('Тема успешно добавлена.', 'success');
        return redirect()->back();
    }


    public function edit(EditTopic $request, $id)
    {
        $topic = Topic::find($id);
        $topic->title = $request->new_title;
        $topic->save();
        flash('Тема успешно изменена.', 'success');
        return redirect()->back();
    }


    public function delete(Request $request, $id)
    {
        $topic = Topic::find($id);
        $topic->questions()->delete();
        $topic->delete();
        flash('Тема успешно удалена.', 'success');
        return redirect()->back();
    }
}
