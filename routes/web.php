<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'miniapp'])->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
Route::patch('/profile', [ProfileController::class, 'update']);
});