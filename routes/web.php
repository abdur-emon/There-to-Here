<?php

use App\Http\Controllers\DateDistanceController;
use Illuminate\Support\Facades\Route;

// Main application route
Route::get('/', [DateDistanceController::class, 'index'])->name('home');

// API endpoint for client-side calculations (optional)
Route::post('/api/calculate', [DateDistanceController::class, 'calculate'])->name('api.calculate');
