<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InspectionController;
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

Route::get('/inspection/preview-no', [InspectionController::class, 'previewNo'])->name('inspection.preview-no');
Route::get('/inspection', [InspectionController::class, 'index'])->name('inspection.index');
Route::post('/inspection', [InspectionController::class, 'store'])->name('inspection.store');
// Route::get('/inspection/create', [InspectionController::class, 'create'])->name('inspection.create');
Route::get('/inspection/failed', [InspectionController::class, 'failed'])->name('inspection.failed');
Route::get('/inspection/{inspection}', [InspectionController::class, 'show'])->name('inspection.show');
Route::get('/inspection/{inspection}/pdf', [InspectionController::class, 'pdf'])->name('inspection.pdf');
Route::get('/inspection/{inspection}/view', [InspectionController::class, 'view'])->name('inspection.view');
Route::delete('/inspection/{id}', [InspectionController::class, 'destroy'])->name('inspection.destroy');

Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
Route::post('/checklist', [ChecklistController::class, 'store'])->name('checklist.store');
Route::put('/checklist/{id}', [ChecklistController::class, 'update'])->name('checklist.update');
Route::delete('/checklist/{id}', [ChecklistController::class, 'destroy'])->name('checklist.destroy');

Route::get('/generator', [GeneratorController::class, 'index'])->name('generator.index');
Route::post('/generator', [GeneratorController::class, 'store'])->name('generator.store');
Route::get('/generator/{id}', [GeneratorController::class, 'show'])->name('generator.show');
Route::put('/generator/{id}', [GeneratorController::class, 'update'])->name('generator.update');
Route::delete('/generator/{id}', [GeneratorController::class, 'destroy'])->name('generator.destroy');

require __DIR__.'/auth.php';
