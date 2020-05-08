<?php

use App\Model\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('questions', 'QuestionsController');


// Route::get('/questions/{question:slug}', function (Questions $question) {
//     return $question;
// });

// Route::get('/questions/{question:id}', function (Questions $question) {
//     return $question;
// });

