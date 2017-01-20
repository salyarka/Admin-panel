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

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
    
// ADD Route::group(['middleware' => ... 
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/admins', 'AdminController@show');
        Route::post('/admins', 'AdminController@add');
        Route::put('/admins/{id}', 'AdminController@edit');
        Route::delete('/admins/{id}', 'AdminController@delete');
    });
    Route::group(['middleware' => ['auth']], function () {

    });
});
