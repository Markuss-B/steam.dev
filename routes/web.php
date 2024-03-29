<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FriendshipsController;
use App\Models\Friendships;

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
Route::get('/', [StoreController::class, 'index'])->name('home');
Route::get('/store', [StoreController::class, 'index'])->name('store');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'role:admin|developer'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // friendships
    Route::get('/friends', [FriendshipsController::class, 'index'])->name('friendships.index');
    Route::post('/friends/{recipient}', [FriendshipsController::class, 'sendFriendRequest'])->name('sendFriendRequest');
    Route::delete('/friends/{recipient}/cancel', [FriendshipsController::class, 'cancelFriendRequest'])->name('cancelFriendRequest');
    Route::patch('/friends/{sender}/accept', [FriendshipsController::class, 'acceptFriendRequest'])->name('acceptFriendRequest');
    Route::delete('/friends/{sender}/decline', [FriendshipsController::class, 'declineFriendRequest'])->name('declineFriendRequest');
    Route::delete('/friends/{friend}/unfriend', [FriendshipsController::class, 'unfriend'])->name('unfriend');
});
// other users
Route::get('/users', [ProfileController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [ProfileController::class, 'show'])->name('user.show');

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
Route::get('/developers/{developer}/games/create', [DeveloperController::class, 'createGame'])->name('developers.games.create');
Route::get('/developers/{developer}/games/{game}/edit', [DeveloperController::class, 'editGame'])->name('developers.games.edit');

// Tags
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{tag}/update', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag}/destroy', [TagController::class, 'destroy'])->name('tags.destroy');

// Library
Route::middleware('auth')->group(function () {
    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::get('/library/{game}', [LibraryController::class, 'show'])->name('library.show');
    // favouriing
    Route::post('/library/{game}/favorite', [LibraryController::class, 'favorite'])->name('library.favorite');
    Route::post('/library/{game}/unfavorite', [LibraryController::class, 'unfavorite'])->name('library.unfavorite');
    // playing games
    Route::post('/library/{game}/play', [LibraryController::class, 'play'])->name('library.play');
    Route::post('/library/{game}/stop', [LibraryController::class, 'stop'])->name('library.stop');

    // categories
    Route::get('/library/categories', [CategoryController::class, 'categories'])->name('category.index');
    Route::resource('categories', CategoryController::class);
});

// Store
Route::middleware('ajax')->group(function () {
    Route::get('/get/store/discounts/{perPage}', [StoreController::class, 'getDiscounts'])->name('get.store.discounts');
    Route::get('/get/store/new/{perPage}', [StoreController::class, 'getNew'])->name('get.store.new');
    Route::get('/get/store/top/{perPage}', [StoreController::class, 'getTopSellers'])->name('get.store.top');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/games/{game}/purchase', [StoreController::class, 'purchase'])->name('game.purchase');
    Route::get('/balance', [StoreController::class, 'balance'])->name('balance');
    Route::post('/balance/add', [StoreController::class, 'addBalance'])->name('balance.add');
    Route::get('/store/purchases', [StoreController::class, 'purchaseHistory'])->name('store.purchases');
});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // make admin, developer
    Route::patch('/make/admin/{user}', [AdminController::class, 'makeAdmin'])->name('make.admin');
    Route::patch('/make/developer/{user}', [AdminController::class, 'makeDeveloper'])->name('make.developer');
    // remove admin, 
    Route::patch('/remove/admin/{user}', [AdminController::class, 'removeAdmin'])->name('remove.admin');
    Route::patch('/remove/developer/{user}', [AdminController::class, 'removeDeveloper'])->name('remove.developer');
    // make user a developer developers.remove-user
    Route::delete('/developers/{developer}/remove-user/{user}', [DeveloperController::class, 'removeUser'])->name('developers.remove-user');
    Route::post('/developers/{developer}/add-user/{user}', [DeveloperController::class, 'addUser'])->name('developers.add-user');

    Route::get('/developers/{developer}/users', [DeveloperController::class, 'users'])->name('developers.users');
});

require __DIR__.'/auth.php';
