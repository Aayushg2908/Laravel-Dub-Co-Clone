<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Redirect;
Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/s/{slug}', [Redirect::class, 'redirect'])->name('redirect');

require __DIR__.'/auth.php';
