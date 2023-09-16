<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class , 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/**news detail routes */

Route::get('news-detail/{slug}' , [HomeController::class, 'ShowNews'])->name('news-detail');

/**news comment routes*/
Route::post('news-comment' , [HomeController::class , 'handleComment'])->name('news-comment');
Route::post('news-comment-reply' , [HomeController::class , 'handleReply'])->name('news-comment-reply');
Route::delete('news-comment-destroy' , [HomeController::class , 'commentDestroy'])->name('news-comment-destroy');
