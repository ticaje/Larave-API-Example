<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

const SLUG_CONSTRAINT = '[A-Za-z0-9-_]+';
const ID_CONSTRAINT = '[0-9]+';
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
Route::get('/', [
    PostController::class,
    'index',
]);
Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});
// Logged in user
Route::middleware(['auth'])->group(function () {
    // Show new post form
    Route::get('new-post', [
        PostController::class,
        'create',
    ]);
    // Save new post
    Route::post('new-post', [
        PostController::class,
        'save',
    ]);
    // Edit post form
    Route::get('edit/{slug}', [
        PostController::class,
        'edit',
    ]);
    // Update post
    Route::post('update', [
        PostController::class,
        'update',
    ]);
    // Delete post
    Route::get('delete/{id}', [
        PostController::class,
        'destroy',
    ]);
    // Show all posts
    Route::get('my-all-posts', [
        UserController::class,
        'all',
    ]);
    // Show drafts
    Route::get('user/{id}/my-drafts', [
        UserController::class,
        'draft',
    ]);
    // Add new comment
    Route::post('comment/add', [
        CommentController::class,
        'save',
    ]);
    // Delete comment
    Route::post('comment/delete/{id}', [
        CommentController::class,
        'destroy',
    ]);
    // User profile
    Route::get('user/{id}', [
        UserController::class,
        'profile',
    ])->where('id', ID_CONSTRAINT);
    // Logout
    Route::get('auth/logout', [
        App\Http\Controllers\LogoutController::class,
        'execute',
    ]);
});
// Show list of posts
Route::get('user/{id}/posts', [
    UserController::class,
    'published',
])->where('id', ID_CONSTRAINT);
// Show single post
Route::get('/{slug}', [
    PostController::class,
    'show',
])->where('slug', SLUG_CONSTRAINT);
