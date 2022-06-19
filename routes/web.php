<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);

Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

// check for logged in user
Route::middleware(['auth'])->group(function () {
    // show new post form
    Route::get('new-post', [App\Http\Controllers\PostController::class, 'create']);
    // save new post
    Route::post('new-post', [App\Http\Controllers\PostController::class, 'save']);
    // edit post form
    Route::get('edit/{slug}', [App\Http\Controllers\PostController::class, 'edit']);
    // update post
    Route::post('update', [App\Http\Controllers\PostController::class, 'update']);
    // delete post
    Route::get('delete/{id}', [App\Http\Controllers\PostController::class, 'destroy']);
    // display user's all posts
    Route::get('my-all-posts', [App\Http\Controllers\UserController::class, 'all']);
    // display user's drafts
    Route::get('user/{id}/my-drafts', [App\Http\Controllers\UserController::class, 'draft']);
    // add comment
    Route::post('comment/add', [App\Http\Controllers\CommentController::class, 'save']);
    // delete comment
    Route::post('comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'destroy']);
    // User information
    Route::get('user/{id}', [App\Http\Controllers\UserController::class, 'profile'])->where('id', '[0-9]+');

    // Logout
    Route::get('auth/logout', [App\Http\Controllers\LogoutController::class, 'execute']);

});

// display list of posts
Route::get('user/{id}/posts', [App\Http\Controllers\UserController::class, 'published'])->where('id', '[0-9]+');

// display single post
Route::get('/{slug}', [App\Http\Controllers\PostController::class, 'show'])->where('slug', '[A-Za-z0-9-_]+');
