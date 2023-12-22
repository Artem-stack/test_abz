<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\PositionController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/users', [PositionController::class, 'index'])->name('users');
    Route::get('/user/token', [PositionController::class, 'getToken'])->name('user.token');
    Route::get('/user/users', [PositionController::class, 'getUserById'])->name('user.profile.search');
    Route::get('/user/positions', [PositionController::class, 'getPositions'])->name('user.positions');
});