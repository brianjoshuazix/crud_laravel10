<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Auth::routes();
Route::middleware(['auth'])->group(function () {
    // Route to view trashed users
Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::resource('users', UserController::class)->middleware('auth');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::resource('users', UserController::class);
Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');


// Route to restore a trashed user
Route::patch('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');

// Route to permanently delete a trashed user
Route::delete('users/{id}/delete', [UserController::class, 'delete'])->name('users.delete');

// Apply the macro for soft deletes routes
Route::softDeletes('users', UserController::class);

// Other route definitions
Route::resource('users', UserController::class)->except(['index', 'show']);
});


// Route to view trashed users
// Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');

// Route to restore a trashed user
// Route::patch('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');

// Route to permanently delete a trashed user
// Route::delete('/users/{id}/delete', [UserController::class, 'delete'])->name('users.delete');


Route::get('/', function () {
    return view('welcome');
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
