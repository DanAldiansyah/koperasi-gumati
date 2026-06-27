<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SavingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::resource('admin', AdminController::class);
    Route::resource('savings', SavingController::class);
    Route::resource('loans', LoanController::class);

    Route::get('loans/{loan}/pay', [LoanController::class, 'pay'])->name('loans.pay');
    Route::post('loans/{loan}/pay', [LoanController::class, 'storePayment'])->name('loans.store-payment');

});
