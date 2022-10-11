<?php

use App\Http\Controllers\Api\MotorController;
use App\Http\Controllers\Api\UserController;
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

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('motor/input', [MotorController::class, 'store']);
    Route::get('motor/show', [MotorController::class, 'show']);
    Route::get('user', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
});
