<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::get('/stockin', function () {
        return view('stockin.index');
    })->name('stockin');

    Route::get('/categories/{category}', [\App\Http\Controllers\ItemsCategoriesController::class, 'show'])
        ->name('categories.show');

    Route::get('/items/{item}', [\App\Http\Controllers\ItemsController::class, 'show'])
        ->name('items.show');

    // Categories routes
    Route::get('/categories', [\App\Http\Controllers\ItemsCategoriesController::class, 'index'])
        ->name('categories.index');

    Route::get('/categories/create', [\App\Http\Controllers\ItemsCategoriesController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories', [\App\Http\Controllers\ItemsCategoriesController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{category}/edit', [\App\Http\Controllers\ItemsCategoriesController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{category}', [\App\Http\Controllers\ItemsCategoriesController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [\App\Http\Controllers\ItemsCategoriesController::class, 'destroy'])
        ->name('categories.destroy');

    // Items routes
    Route::get('/items', [\App\Http\Controllers\ItemsController::class, 'index'])
        ->name('items.index');

    Route::get('/items/create', [\App\Http\Controllers\ItemsController::class, 'create'])
        ->name('items.create');

    Route::post('/items', [\App\Http\Controllers\ItemsController::class, 'store'])
        ->name('items.store');

    Route::get('/items/{item}/edit', [\App\Http\Controllers\ItemsController::class, 'edit'])
        ->name('items.edit');

    Route::put('/items/{item}', [\App\Http\Controllers\ItemsController::class, 'update'])
        ->name('items.update');

    Route::delete('/items/{item}', [\App\Http\Controllers\ItemsController::class, 'destroy'])
        ->name('items.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
