<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\BuildController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\FrontendController;
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


// admin route 
Route::prefix('admin')->group(function () {    
    Route::get('/login', [AuthController::class, 'index'])->name('backend.auth.index');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('backend.auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('backend.auth.logout');
    Route::middleware(['auth', 'admin'])->group(function () {    
        Route::post('build/dropzoneMedia', [BuildController::class, 'dropzoneMedia'])->name('build.media');
        Route::resource('build', BuildController::class);
        Route::post('room/dropzoneMedia', [RoomController::class, 'dropzoneMedia'])->name('room.media');
        Route::resource('room', RoomController::class);
    });
});

// user route

Route::get('/login', [FrontendController::class, 'login'])->name('frontend.auth.index');
Route::post('/login', [FrontendController::class, 'authenticate'])->name('frontend.auth.login');
Route::get('/logout', [FrontendController::class, 'logout'])->name('frontend.auth.logout');
Route::middleware('user')->group(function () {    
    Route::get('/', [FrontendController::class, 'buildList'])->name('frontend.build.index');
    Route::get('/build-detail/{build_id}/{room_id?}', [FrontendController::class, 'buildDetail'])->name('frontend.build.detail');
});