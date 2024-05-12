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
Route::get('/login/{email}/{password}', [PostsController::class, 'sso_login'])->name('sso_login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/modify-posts/{postid}', [PostsController::class, 'index_modify'])->name('posts.index.modify');
Route::post('/new-modify', [PostsController::class, 'new_modify'])->name('posts.new.modify');
Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
Route::post('/posts/create', [PostsController::class, 'new_create'])->name('posts.new.create');
Route::get('/posts/search', [PostsController::class, 'search'])->name('posts.search');