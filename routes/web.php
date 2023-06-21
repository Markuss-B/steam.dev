<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\TagController;

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

// Home
Route::get('/', function () {
    return view('welcome-steam');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Games
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
Route::post('/games/store', [GameController::class, 'store'])->name('games.store');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
Route::put('/games/{game}/update', [GameController::class, 'update'])->name('games.update');
Route::delete('/games/{game}/destroy', [GameController::class, 'destroy'])->name('games.destroy');
Route::get('/search', [GameController::class, 'search'])->name('games.search');

// Developers
Route::get('/developers', [DeveloperController::class, 'index'])->name('developers.index');
Route::get('/developers/create', [DeveloperController::class, 'create'])->name('developers.create');
Route::post('/developers/store', [DeveloperController::class, 'store'])->name('developers.store');
Route::get('/developers/{developer}', [DeveloperController::class, 'show'])->name('developers.show');
Route::get('/developers/{developer}/edit', [DeveloperController::class, 'edit'])->name('developers.edit');
Route::put('/developers/{developer}/update', [DeveloperController::class, 'update'])->name('developers.update');
Route::delete('/developers/{developer}/destroy', [DeveloperController::class, 'destroy'])->name('developers.destroy');

// Tags
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{tag}/update', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag}/destroy', [TagController::class, 'destroy'])->name('tags.destroy');

// Purchase game
Route::post('/games/{game}/purchase', [LibraryController::class, 'purchase'])->name('game.purchase')->middleware('auth');

// Library
Route::get('/library', [LibraryController::class, 'index'])->name('library.index')->middleware('auth');
Route::get('/library/{game}', [LibraryController::class, 'show'])->name('library.show')->middleware('auth');
Route::post('/library/{game}/favorite', [LibraryController::class, 'favorite'])->name('library.favorite')->middleware('auth');
Route::post('/library/{game}/unfavorite', [LibraryController::class, 'unfavorite'])->name('library.unfavorite')->middleware('auth');


require __DIR__.'/auth.php';
