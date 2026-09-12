<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/password.email',)->name('password.email');
Route::get('/resetPassword',[AuthController::class,'showResetPassword'])->name('resetPassword');
Route::get('/register',[AuthController::class,'showRegister'])->middleware('guest')->name('register');
Route::get('/',[AuthController::class,'showLogin'])->middleware('guest')->name('login');
