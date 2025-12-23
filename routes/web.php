<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckSheetController;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\ChecklistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/calendar', function () {return view('calendar');})->name('calendar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/check-sheet', [CheckSheetController::class, 'index'])->name('check_sheet.index');
Route::post('/check-sheet', [CheckSheetController::class, 'store'])->name('check_sheet.store');
Route::get('/check-sheet/create', [CheckSheetController::class, 'create'])->name('check_sheet.create');
Route::get('/check-sheet/failed', [CheckSheetController::class, 'failed'])->name('check_sheet.failed');
Route::get('/check-sheet/{id}', [CheckSheetController::class, 'show'])->name('check_sheet.show');
Route::delete('/check-sheet/{id}', [CheckSheetController::class, 'destroy'])->name('check_sheet.destroy');

Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
Route::post('/checklist', [ChecklistController::class, 'store'])->name('checklist.store');
Route::get('/checklist/create', [ChecklistController::class, 'create'])->name('checklist.create');
Route::put('/checklist/{id}', [ChecklistController::class, 'update'])->name('checklist.update');
Route::get('/checklist/edit/{id}', [ChecklistController::class, 'edit'])->name('checklist.edit');
Route::delete('/checklist/{id}', [ChecklistController::class, 'destroy'])->name('checklist.destroy');

Route::get('/generator', [GeneratorController::class, 'index'])->name('generator.index');
Route::post('/generator', [GeneratorController::class, 'store'])->name('generator.store');
Route::get('/generator/create', [GeneratorController::class, 'create'])->name('generator.create');
Route::get('/generator/{id}', [GeneratorController::class, 'show'])->name('generator.show');
Route::get('/generator/edit/{id}', [GeneratorController::class, 'edit'])->name('generator.edit');
Route::delete('/generator/{id}', [GeneratorController::class, 'destroy'])->name('generator.destroy');

require __DIR__.'/auth.php';
