<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\DesignDemoController;
use App\Http\Controllers\API\UserController;

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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'books', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('add', [BookController::class, 'add']);
    Route::get('edit/{id}', [BookController::class, 'edit']);
    Route::post('update/{id}', [BookController::class, 'update']);
    Route::delete('delete/{id}', [BookController::class, 'delete']);
});
Route::group(['prefix' => 'template', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [DesignDemoController::class, 'index']);
    Route::get('/get-demo/{demo}', [DesignDemoController::class, 'getDemo']);
    Route::post('store', [DesignDemoController::class, 'store']);
    Route::get('edit/{id}', [DesignDemoController::class, 'edit']);
    Route::post('update/{id}', [DesignDemoController::class, 'update']);
    Route::delete('delete/{id}', [DesignDemoController::class, 'delete']);
});

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/