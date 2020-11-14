<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Api\MessageController;

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

Route::get('/', [PageController::class, 'welcome'])->name('welcome');

/**
 * * These routes the user should be logged into to use the application
 */
Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'dashboard'], function () {
    Route::get("/", [PageController::class, 'dashboard'])->name('dashboard');

    Route::get("/me", function (Request $request) {
        dd($request->user());
    });

    Route::get("/chat", [PageController::class, 'chat'])->name('chat');
});

// API Routes
// * TEMPORARY BECAUSE THE AUTH DOES NOT WORKING IN api.php
Route::group(['prefix' => 'api', 'middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get("/users/me", [UserController::class, 'me']);
    Route::get("/users/{user}", [UserController::class, 'show']);
    Route::get("/users/except-logged-in", [UserController::class, 'getAllUsersExceptLoggedIn']);
    Route::get("/messages/{user}", [MessageController::class, 'index']);

    Route::post("/messages", [MessageController::class, 'store']);
});
