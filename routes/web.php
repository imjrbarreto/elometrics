<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('workspaces', WorkspaceController::class);
    Route::resource('workspaces.students', StudentController::class)->only(['create', 'store', 'destroy']);
    Route::get('/workspaces/{workspace}/training-sessions/create', [TrainingSessionController::class, 'create'])->name('training-sessions.create');
    Route::post('/workspaces/{workspace}/training-sessions', [TrainingSessionController::class, 'store'])->name('training-sessions.store');
    Route::get('/workspaces/{workspace}/training-sessions/{trainingSession}', [TrainingSessionController::class, 'show'])->name('training-sessions.show');
});

require __DIR__.'/auth.php';
