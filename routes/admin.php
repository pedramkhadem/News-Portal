<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\admin\NewsController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\ProfileController;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('login', [AdminAuthenticationController::class,'login'])->name('login');
    Route::post('login', [AdminAuthenticationController::class,'handlelogin'])->name('handle-login');
    Route::post('logout', [AdminAuthenticationController::class,'logout'])->name('logout');

    /** Reset passwrod **/
    Route::get('forgot-password', [AdminAuthenticationController::class,'forgotpassword'])->name('forgot-password');
    Route::post('forgot-password', [AdminAuthenticationController::class,'sendResetlink'])->name('forgot-password.send');
    Route::get('reset-password/{token}', [AdminAuthenticationController::class,'resetPassword'])->name('reset-password');
    Route::post('reset-password', [AdminAuthenticationController::class,'handleresetPassword'])->name('reset-password.send');



});

Route::group(['prefix' => 'admin', 'as' => 'admin.' , 'middleware'=>['admin']], function(){

    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

    /**update password */
    Route::put('profile-password-update/{id}',[ProfileController::class, 'passwordUpdate'])->name('profile-password.update');
    /** Profile Routes  **/
    Route::resource('profile', ProfileController::class);

    /**Language Route */
    Route::resource('language', LanguageController::class);

    /**Category Route */
    Route::resource('category', CategoryController::class);

      /**News Route */

      Route::get('fetch-news-category' , [NewsController::class , 'fetchCategory'])->name('fetch-news-category');

      Route::get('toggle-news-status' , [NewsController::class , 'toggleNewsStatus'])->name('toggle-news-status');
      Route::get('news-copy/{id}' , [NewsController::class , 'copyNews'])->name('news-copy');

      Route::resource('news', NewsController::class);


});
