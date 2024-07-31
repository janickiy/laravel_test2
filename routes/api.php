<?php


use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->middleware('api')->group(function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');
});

Route::group(['prefix' => 'post'], function () {
    Route::get('list', [PostController::class, 'list'])->name('post.list');
    Route::get('{id}', [PostController::class, 'getPost'])->name('post.get')->where('id', '[0-9]+');
    Route::post('store', [PostController::class, 'store'])->name('post.store');
    Route::put('update', [PostController::class, 'update'])->name('post.update');
    Route::post('delete', [PostController::class, 'delete'])->name('post.delete');
});

Route::group(['prefix' => 'comment'], function () {
    Route::post('add', [CommentController::class, 'add'])->name('comment.add');
    Route::post('delete', [CommentController::class, 'delete'])->name('post.delete');
});

Route::group(['prefix' => 'like'], function () {
    Route::post('like', [LikeController::class, 'like'])->name('like');
});
