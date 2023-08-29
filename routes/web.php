<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });


Route::get('/', 'HomeController@home')->name('home');
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::resource('/post', 'PostController');
// ->except(['destroy']);
// only(['index', 'show', 'create', 'store','edit','update']);

Route::get('/blog-post/{id}/{welcome?}', 'HomeController@blogPost')->name('blog-post');


// Route::view('/contact', 'contact')->name('contact');
// Route::get('/layout', function () {
//     return view('layout');
// });