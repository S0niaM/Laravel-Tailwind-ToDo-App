<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ListController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    

Route::post('/items', [ListController::class, 'store'])
    ->name('items.store');


Route::patch('/items/{item}', [ListController::class, 'update'])
    ->name('items.update');


Route::delete('/items/{item}', [ListController::class, 'destroy'])
    ->name('items.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
