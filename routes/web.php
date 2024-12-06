<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\ToolsController;
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

    Route::resource('simulation', SimulationController::class);
    Route::get('/simulation-index', [SimulationController::class, 'index'])->name('simulation.index');

    Route::resource('tools', ToolsController::class);
    Route::get('/tools-index', [ToolsController::class, 'index'])->name('tools.index');
    Route::post('/tools', [ToolsController::class, 'store'])->name('tools.store');
    Route::get('/tools-store', [ToolsController::class, 'create'])->name('tools.create');
    Route::get('/tools-search', [ToolsController::class, 'search'])->name('tools.search');
});

require __DIR__ . '/auth.php';
