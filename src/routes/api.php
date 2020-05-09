<?php

use App\Model\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Routes for Questions
Route::apiResource('questions', 'QuestionsController');

//Routed for Categories
Route::apiResource('categories', 'CategoriesController');

// Route::get('/questions/{question:slug}', function (Questions $question) {
//     return $question;
// });

// Route::get('/questions/{question:id}', function (Questions $question) {
//     return $question;
// });

