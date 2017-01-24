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
        return ($request->route()->getPrefix() == '/admin');
    }

    /**
     * Display a faq with answered questions
     *
     * @param  Request  $request
     * @return Response
     **/
    public function show(Request $request)
    {
        $topics = Topic::all();
        $topicsWithAnsweres = Topic::whereHas('questions', function ($query) {
            $query->whereNotNull('answer');
        })->get();
        $view = $this->isAdminRequest($request) ? 'admin_panel.faq' : 'faq';
        return view($view, ['topics' => $topics,'topicsWithAnsweres' => $topicsWithAnsweres]);
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
        return redirect('admin/faq');
    }


    public function edit(EditTopic $request, $id)
    {
        $topic = Topic::find($id);
        $topic->title = $request->new_title;
        $topic->save();
        flash('Тема успешно изменена.', 'success');
        return redirect('admin/faq');
    }


    public function delete()
    {

    }
}
