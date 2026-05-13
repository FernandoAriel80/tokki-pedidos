<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PorfileController;
use Illuminate\Support\Facades\Route;

Route::get('/register', fn() => view('pages.auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', fn() => view('pages.auth.login'))->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('home.search');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/create-order', [OrderController::class, 'index']);
    Route::post('/create-order', [OrderController::class, 'store']);
    Route::get('/view-order/{id}', [OrderController::class, 'oneOrder'])->name('orderView');
    Route::get('/view-update/{id}', [OrderController::class, 'update']);
    Route::put('/save-order/{id}', [OrderController::class, 'save']);
    Route::delete('/view-delete/{id}', [OrderController::class, 'delete']);

    Route::get('/porfile', [PorfileController::class, 'index'])->name('porfile');

    Route::put('/change-password', [PorfileController::class, 'changePassword']);


    Route::middleware('role:admin')->group(function () {
        Route::get('/view-admin', [AdminController::class, 'index'])->name('dasboard');
        Route::put('/user-update/{id}', [AdminController::class, 'update']);
        Route::delete('/user-delete/{id}', [AdminController::class, 'delete']);
    });
});
