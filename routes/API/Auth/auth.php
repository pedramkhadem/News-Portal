<?php

use App\Http\Controllers\API\Admin\AdminAuthController;
use App\Http\Controllers\API\Admin\AdminCatController;
use App\Http\Controllers\API\Admin\AdminHomeSectionController;
use App\Http\Controllers\API\Admin\AdminImageController;
use App\Http\Controllers\API\Admin\AdminLangController;
use App\Http\Controllers\API\Admin\AdminNewsController;
use App\Http\Resources\Admin\AdminNewsResource;
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

        //categories Route
        Route::apiResource('category' , AdminCatController::class);
        //Language Route
        Route::apiResource('language', AdminLangController::class);
        //News Route
        Route::apiResource('news' , AdminNewsController::class);
        //Image handler
        Route::post('news/image',  [AdminImageController::class , 'image']);

        // Route::apiResource('section' , AdminHomeSectionController::class);


    });
