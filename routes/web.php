<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AuthController;

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
Route::get('/test', function(){
    dd('test');
});

// Route::get('/login/{email}/{password}', [PostsController::class, 'sso_login'])->name('sso_login');
Route::get('/login/{email}', [PostsController::class, 'sso_login'])->name('sso_login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/modify-posts/{postid}', [PostsController::class, 'index_modify'])->name('posts.index.modify');
Route::post('/new-modify', [PostsController::class, 'new_modify'])->name('posts.new.modify');
Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
Route::post('/posts/create', [PostsController::class, 'new_create'])->name('posts.new.create');
Route::get('/posts/search', [PostsController::class, 'search'])->name('posts.search');
Route::post('/posts/search/result', [PostsController::class, 'search_result'])->name('posts.search.result');

Route::delete('/new-delete/{postid}', [PostsController::class, 'destroy'])->name('posts.new.delete');
Route::post('/new-like', [PostsController::class, 'like'])->name('posts.new.like');

Route::post('/new-comment', [PostsController::class, 'comment'])->name('posts.new.comment');
Route::delete('/comment-delete/{commentid}', [PostsController::class, 'comment_destroy'])->name('posts.comment.delete');

Route::get('/blog', [PostsController::class, 'index_blog'])->name('index.blog');

Route::post('/posts/new/load-sub-categories', [PostsController::class, 'loadSubCategories'])->name('posts.new.load-sub-categories');