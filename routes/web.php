<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('back.index-back');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
});


Route::middleware(['auth', RoleMiddleware::class . ':super_admin'])->group(function () {
    Route::get('/dashboard', [AppController::class,'index'])->name('dashboard.index');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //User Routes
    Route::get('/user-management', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-management/process/add', [UserController::class, 'store'])->name('user.store');
    Route::put('/user-management/process/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user-management/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    // Admin Routes
    Route::get('/admin-management', [AdminController::class, 'index'])->name('user.index');

    // Book Routes
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
});

require __DIR__.'/auth.php';
