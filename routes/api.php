<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1/auth')->group(function () {
    Route::post('Register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
    Route::post('Login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('unAuthorized', [App\Http\Controllers\Auth\LoginController::class, 'authView'])->name('authView');
    Route::post('Logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->middleware('auth');
});

Route::prefix('v1')->middleware('auth')->group(function () {

    Route::get('Categories', [CategoryController::class, 'index']);
    Route::get('Categories/{id}', [CategoryController::class, 'show']);
    Route::patch('Categories/{id}/update', [CategoryController::class, 'update']); //make it patch 
    Route::post('Categories', [CategoryController::class, 'store']);
    Route::DELETE('Categories/{id}/delete', [CategoryController::class, 'destroy']);

    Route::get('Posts', [PostController::class, 'index']);
    Route::get('Posts/{id}', [PostController::class, 'show']);
    Route::post('Posts', [PostController::class, 'store']);
    Route::patch('Posts/{id}/update', [PostController::class, 'update']);
    Route::DELETE('Posts/{id}/delete', [PostController::class, 'destroy']);
});

Route::prefix('v1/website')->group(function () {
    Route::get('Categories', [WebsiteController::class, 'getCategories']);
});
// Route::get('/test', function () {
//     return auth()->user();
// })->middleware('auth');
