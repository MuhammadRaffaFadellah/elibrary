<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AppController::class, 'landing'])->name('landing');

Route::middleware(['auth', RoleMiddleware::class . ':admin,super_admin'])->group(function () {
    Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard.index');

    //User Routes
    Route::get('/user-management', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-management/process/add', [UserController::class, 'store'])->name('user.store');
    Route::put('/user-management/process/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user-management/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    // Category Routes
    Route::get('/category', [CategoryController::class,'index'])->name('category.index');
    Route::post('/category/process/add', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/process/edit/{id}', [CategoryController::class, 'update'])->name('        .update');
    Route::delete('/category/delete/{id}', [CategoryController::class,'destroy'])->name('category.delete');

    // Book Routes
    Route::get('/books', [BookController::class, 'index'])->name('book.index');
    Route::post('/books/process/add', [BookController::class, 'store'])->name('book.store');
    Route::put('/books/process/edit/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/books/delete/{id}', [BookController::class,'destroy'])->name('book.delete');
});


Route::middleware(['auth', RoleMiddleware::class . ':super_admin'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::get('/admin-management', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin-management/process/add', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin-management/process/edit/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin-management/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});

require __DIR__ . '/auth.php';
