<?php

use App\Http\Controllers\API\Admin\AdminAuthController;
use App\Http\Controllers\API\Admin\AdminCatController;
use App\Http\Controllers\API\Admin\AdminLangController;
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
// */




    Route::post('admin/login', [AdminAuthController::class, 'login']);

   Route::middleware('auth:sanctum' ,'type.admin')->get('/admin', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'admin' , 'middleware'=>['auth:sanctum', 'type.admin']], function(){
        //logout admin
        Route::post('logout' , [AdminAuthController::class , 'logout']);

        //update admin profile
        Route::put('update/{admin}' , [AdminAuthController::class , 'update']);

        //index categories
        Route::apiResource('category' , AdminCatController::class);
        Route::apiResource('language', AdminLangController::class);

        

    });
