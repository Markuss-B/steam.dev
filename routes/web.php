<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DeveloperController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Games
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
Route::post('/games/store', [GameController::class, 'store'])->name('games.store');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
Route::put('/games/{game}/update', [GameController::class, 'update'])->name('games.update');
Route::delete('/games/{game}/destroy', [GameController::class, 'destroy'])->name('games.destroy');

// Developers
Route::get('/developers', [DeveloperController::class, 'index'])->name('developers.index');
Route::get('/developers/create', [DeveloperController::class, 'create'])->name('developers.create');
Route::post('/developers/store', [DeveloperController::class, 'store'])->name('developers.store');
Route::get('/developers/{developer}', [DeveloperController::class, 'show'])->name('developers.show');
Route::get('/developers/{developer}/edit', [DeveloperController::class, 'edit'])->name('developers.edit');
Route::put('/developers/{developer}/update', [DeveloperController::class, 'update'])->name('developers.update');
Route::delete('/developers/{developer}/destroy', [DeveloperController::class, 'destroy'])->name('developers.destroy');

// Publishers
