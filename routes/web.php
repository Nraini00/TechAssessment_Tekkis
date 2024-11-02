<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\SavingController;



Route::view('/', 'welcome')->name('welcome');
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Referral Creation
    Route::view('/referral', 'referral')->name('referral');
    Route::post('/create-referral', [ReferralController::class, 'createReferral'])->name('referral.create');

    // Deposit Savings
    Route::get('/deposit', [SavingController::class, 'deposit'])->name('deposit');
    Route::post('/deposit', [SavingController::class, 'storeDeposit'])->name('deposit.post');
    
});
