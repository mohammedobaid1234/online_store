<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Chatify\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('auth/tokens', [AccessTokenController::class , 'store']);
Route::post('auth/verification', [AccessTokenController::class, 'CheckVerificationCode']);
Route::apiResource('categories', CategoryController::class)->middleware('auth:sanctum');

