<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/faq', 'FaqController@show');
Route::post('/faq', 'TopicController@add');

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout')->middleware('auth');
    
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'blocked'], function () { 
        Route::get('/', 'TopicController@showBlocked');
        Route::post('/', 'WordController@addWord');
        Route::delete('/{id}', 'WordController@deleteWord');
    });

    Route::group(['prefix' => 'faq'], function () {
        Route::get('/', 'FaqController@show');  
        Route::post('/', 'FaqController@add');
        Route::put('/{id}', 'FaqController@edit');
        Route::delete('/{id}', 'FaqController@delete');
        Route::get('/unanswered', 'TopicController@showUnAnswered');

        Route::group(['prefix' => 'topic'], function () {
            Route::get('/{id}', 'TopicController@show');  
            Route::post('/{id}', 'TopicController@add');
            Route::put('/{question_id}', 'TopicController@edit');
            Route::put('/{question_id}/answer', 'TopicController@answer');            
            Route::patch('/{question_id}', 'TopicController@hide');
            Route::delete('/{question_id}', 'TopicController@delete');
        });
    });

    Route::group(['middleware' => 'role:superAdmin'], function () {
        Route::get('/', 'AdminController@show');
        Route::post('/', 'AdminController@add');
        Route::put('/{id}', 'AdminController@edit');
        Route::delete('/{id}', 'AdminController@delete');
    });
  
});
