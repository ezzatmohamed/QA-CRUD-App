<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login','UserController@login');
Route::post('/signup','UserController@signup');
Route::post('/logout','UserController@logout');

Route::group(['prefix'=>'/question','middleware' => ['CheckAuth']],function(){
    Route::post('/create','QuestionController@create');
    Route::post('/update/{id}','QuestionController@update')->middleware('QuestionBelongsToUser');
    Route::post('/delete/{id}','QuestionController@delete')->middleware('QuestionBelongsToUser');
    Route::get('/read-all','QuestionController@readAll');
    Route::get('/read-mine','QuestionController@readMine');
});

Route::group(['prefix'=>'/answer','middleware' => ['CheckAuth']],function(){
    Route::post('/create','AnswerController@create');
    Route::get('/read/{id}','AnswerController@read');
    Route::post('/update/{id}','AnswerController@update')->middleware('AnswerBelongsToUser');
    Route::post('/delete/{id}','AnswerController@delete')->middleware('AnswerBelongsToUser');
});