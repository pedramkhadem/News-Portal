<?php

use App\Http\Controllers\API\User\UserAuthController;
use Illuminate\Http\Request;
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


Route::post('user/login', [UserAuthController::class, 'login']);

Route::middleware('auth:sanctum' ,'type.user')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'user' , 'middleware'=>['auth:sanctum', 'type.user']], function(){

    Route::post('logout' , [UserAuthController::class , 'logout']);
    //create new user
    Route::post('register' , [UserAuthController::class , 'register']);
    //update user
    Route::put('update/{user}' , [UserAuthController::class, 'update']);




});
