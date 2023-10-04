<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/profile', [AuthenticationController::class, 'profile']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware('owner-post');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('owner-post');

    Route::post('/comment', [CommentController::class, 'store']);
    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware('owner-comment');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware('owner-comment');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);


Route::post('/login', [AuthenticationController::class, 'login']);
