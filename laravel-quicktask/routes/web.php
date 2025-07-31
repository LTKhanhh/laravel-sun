<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// User routes
Route::resource('/users', UserController::class);

// Task routes
Route::get('/tasks', [TaskController::class, 'index'])->name("users.tasks.index");
Route::get('/users/{user}/tasks/create', [TaskController::class, 'create'])->name("users.tasks.create");
Route::post('/users/{user}/tasks', [TaskController::class, 'store'])->name("users.tasks.store");
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name("tasks.show");
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name("tasks.edit");
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name("tasks.update");
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name("tasks.destroy");






Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
