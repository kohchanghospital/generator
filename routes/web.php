<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConditionChecklistController;
use App\Http\Controllers\GeneratorController;
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

Route::get('/generator-checklist', [ConditionChecklistController::class, 'index'])->name('checklist.index');
Route::get('/generator-checklist/create', [ConditionChecklistController::class, 'create'])->name('checklist.create');
Route::post('/generator-checklist', [ConditionChecklistController::class, 'store'])->name('checklist.store');
Route::get('/generator-checklist/failed', [ConditionChecklistController::class, 'failed'])->name('checklist.failed');
Route::get('/generator', [GeneratorController::class, 'index'])->name('generator.index');
Route::get('/generator/create', [GeneratorController::class, 'create'])->name('generator.create');
Route::post('/generator', [GeneratorController::class, 'store'])->name('generator.store');
Route::get('/generator-checklist/{id}', [ConditionChecklistController::class, 'show'])->name('checklist.show');
Route::delete('/generator-checklist/{id}', [ConditionChecklistController::class, 'destroy'])->name('checklist.destroy');

require __DIR__.'/auth.php';
