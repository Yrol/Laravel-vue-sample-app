<?php

use App\Model\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route for Questions
Route::apiResource('questions', 'QuestionsController');

//Route for Categories
Route::apiResource('categories', 'CategoriesController');

//Route for replies - "questions/{question ID or slug}/reply/"
Route::apiResource('question/{question}/reply', 'RepliesController');


// Route::get('/questions/{question:slug}', function (Questions $question) {
//     return $question;
// });

// Route::get('/questions/{question:id}', function (Questions $question) {
//     return $question;
// });

