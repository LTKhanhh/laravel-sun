<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\SuperAdminCheck;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User routes
Route::get('/users', [UserController::class, 'index'])->name("users.index");
Route::get('/users/create', [UserController::class, 'create'])->name("users.create")->middleware(SuperAdminCheck::class);
Route::post('/users', [UserController::class, 'store'])->name("users.store")->middleware(SuperAdminCheck::class);
Route::get('/users/{user}', [UserController::class, 'show'])->name("users.show");
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name("users.edit")->middleware(SuperAdminCheck::class);
Route::patch('/users/{user}', [UserController::class, 'update'])->name("users.update")->middleware(SuperAdminCheck::class);
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name("users.destroy")->middleware(SuperAdminCheck::class);

// Task routes
Route::get('/tasks', [TaskController::class, 'index'])->name("users.tasks.index");
Route::get('/users/{user}/tasks/create', [TaskController::class, 'create'])->name("users.tasks.create");
Route::post('/users/{user}/tasks', [TaskController::class, 'store'])->name("users.tasks.store");
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name("tasks.show");
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name("tasks.edit");
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name("tasks.update");
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name("tasks.destroy");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/language/{language}', [LanguageController::class, 'changeLanguage'])->name('language.change');


require __DIR__.'/auth.php';
