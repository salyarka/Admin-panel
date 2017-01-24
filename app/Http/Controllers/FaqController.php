<?php

namespace App\Http\Controllers;

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
}
