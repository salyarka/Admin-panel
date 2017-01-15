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

Route::get('/', function () {
    return view('index');
});

Route::get('/faq', 'FaqController');
Route::post('/faq', 'QuestionController');

// ADD Route::group(['middleware' => ... 
Route::get('/admins', 'AdminController@show');
Route::post('/admins', 'AdminController@add');
Route::put('/admins/{admin}', 'AdminController@edit');
Route::delete('/admins/{admin}', 'AdminController@delete');
