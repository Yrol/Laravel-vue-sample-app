<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('home');
// });

//
Route::view('/', 'home');
/**
 * if there is anything on the route (ex: localhost:8000/login) it will always return the home route but will retain the {any} value in the URL, the Vue route will catch this {any} value and render.
 * Without this in place, Laravel will throw 404 from its routes.
 */
Route::view('/{any}', 'home');
Route::view('/question/{any}', 'home');//route for viewing a single question
