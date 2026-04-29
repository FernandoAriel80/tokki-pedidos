<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/register', fn() => view('pages.admin.register'))->name('register');
Route::post('/register', [AdminController::class, 'register']);
Route::get('/login', fn() => view('pages.admin.login'))->name('login');
Route::post('login', [AdminController::class, 'login']);

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('home.search');
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::get('/create-order', [OrderController::class, 'index']);
    Route::post('/create-order', [OrderController::class, 'store']);
    Route::get('/view-order/{id}', [OrderController::class, 'oneOrder']);
});
