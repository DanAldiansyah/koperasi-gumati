<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\LoanController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('savings', SavingController::class);
Route::resource('loans', LoanController::class);