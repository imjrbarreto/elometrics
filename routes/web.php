<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\WorkspaceMemberController;
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
    Route::get('/workspaces/{workspace}/training-sessions/{trainingSession}/edit', [TrainingSessionController::class, 'edit'])->name('training-sessions.edit');
    Route::patch('/workspaces/{workspace}/training-sessions/{trainingSession}', [TrainingSessionController::class, 'update'])->name('training-sessions.update');
    Route::delete('/workspaces/{workspace}/training-sessions/{trainingSession}', [TrainingSessionController::class, 'destroy'])->name('training-sessions.destroy');
    Route::post('workspaces/{workspace}/members', [WorkspaceMemberController::class, 'store'])->name('workspaces.members.store');
    Route::delete('workspaces/{workspace}/members/{member}', [WorkspaceMemberController::class, 'destroy'])->name('workspaces.members.destroy');
    Route::delete('workspaces/{workspace}/membership', [WorkspaceMemberController::class, 'leave'])->name('workspaces.members.leave');
});

require __DIR__.'/auth.php';
