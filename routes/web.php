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

Route::get('/',[App\Http\Controllers\PostsController::class,'index']);

Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => ['admin']],function(){
    Route::get('/dashboard',[App\Http\Controllers\PostApproveController::class,'index'])->name('admin.dashboard');
    Route::put('/post/{id}/approve',[App\Http\Controllers\PostApproveController::class,'update'])->name('post.approve');

});
Route::get('/home', [App\Http\Controllers\PostsController::class,'index'])->name('home');
Route::resource('posts',App\Http\Controllers\PostsController::class)->except('show');
Route::get('/posts/{slug}',[App\Http\Controllers\PostsController::class,'show'])->name('posts.show');
Route::resource('/posts.comments',App\Http\Controllers\CommentController::class)->except('index','show','create');
Route::get('/user/{id}',[App\Http\Controllers\ProfileController::class,'show'])->name('user.show');
Route::get('profile/{id}/edit',[App\Http\Controllers\ProfileController::class,'edit'])->name('profilepost.edit');
Route::put('profile/post/{id}',[App\Http\Controllers\ProfileController::class,'update'])->name('profilepost.update');