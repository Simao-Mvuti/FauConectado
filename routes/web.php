<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/password.email',)->name('password.email');
Route::get('/resetPassword',[AuthController::class,'showResetPassword'])->name('resetPassword');
Route::get('/register',[AuthController::class,'showRegister'])->middleware('guest')->name('register');
Route::post('/register',[AuthController::class,'register'])->middleware('guest')->name('register.store');
Route::post('/login',[AuthController::class,'login'])->middleware('guest')->name('login.store');
Route::get('/',[AuthController::class,'showLogin'])->middleware('guest')->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');
