<?php

use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\User\PersonalController;
use Illuminate\Support\Facades\Route;


Route::post('/insurance/buy', [InsuranceController::class, 'buy'])->name('insurance.buy');

Route::get('/personal', [PersonalController::class, 'index'])->name('personal.index');
Route::post('/personal', [PersonalController::class, 'store'])->name('personal.store');
