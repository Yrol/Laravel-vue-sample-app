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
Route::view('/{any}', 'home'); // if there is anything on the route (ex: localhost:8000/login) it will still return home, that way the URL will stay the same "/login" and Vue will catch {any} and render based on that
