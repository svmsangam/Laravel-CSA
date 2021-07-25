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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('posts',App\Http\Controllers\PostsController::class)->except('show');
Route::get('/posts/{slug}',[App\Http\Controllers\PostsController::class,'show'])->name('posts.show');
Route::resource('/posts.comments',App\Http\Controllers\CommentController::class)->except('index','show','create');

