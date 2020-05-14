<?php

use App\Model\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route for Questions
Route::apiResource('questions', 'QuestionsController');

//Route for Categories
Route::apiResource('categories', 'CategoriesController');

//Route for Replies - "questions/{question ID or slug}/reply/"
Route::apiResource('question/{question}/reply', 'RepliesController');

//Route for Likes - this will only have two main functions as to Like and Delete
Route::post('like/{reply}', 'LikesController@like');
Route::delete('like/{reply}', 'LikesController@unlike');


/**
 * Route for JWT authentication - as per the documentation in https://github.com/tymondesigns/jwt-auth
 * The prefix for auth will be "auth", which means " http://localhost:8080/api/auth" and followed by the functions defined in the "AuthController"
 */
Route::group([
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload' ); //payload will give information/metadata about the token: Eg: expiry time, issue end point(/login, /refresh & etc) & etc
    Route::post('getAuthenticatedUser', 'AuthController@getAuthenticatedUser');

});


// Route::get('/questions/{question:slug}', function (Questions $question) {
//     return $question;
// });

// Route::get('/questions/{question:id}', function (Questions $question) {
//     return $question;
// });

