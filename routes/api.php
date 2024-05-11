<?php

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

Route::get('haircuts', 'ApiController@haircuts');
Route::get('quizzes', 'ApiController@quizzes');
Route::post('quizzes/{quiz}/answers', 'ApiController@storeAnswers');
   
Route::get('packed-haircuts', 'ApiController@packedHaircuts');
Route::post('packed-haircuts/{haircut}', 'ApiController@submitPackedSelection');
