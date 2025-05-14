<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [UserController::class, 'register']);
Route::get('/profile', [UserController::class, 'profile']);
