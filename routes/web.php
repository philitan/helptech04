<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\ConditionsController;
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
    Route::get('/simulation-tools', [SimulationController::class, 'tools'])->name('simulation.tools');
    Route::post('/result-index',[ResultController::class,'index'])->name('result.index');


    Route::resource('tools', ToolsController::class);
    Route::get('/tools-index', [ToolsController::class, 'index'])->name('tools.index');
    Route::post('/tools', [ToolsController::class, 'store'])->name('tools.store');
    Route::get('/tools-store', [ToolsController::class, 'create'])->name('tools.create');
    Route::get('/tools-search', [ToolsController::class, 'search'])->name('tools.search');
    Route::delete('/tools/{tool}', [ToolsController::class, 'destroy'])->name('tools.destroy');

    Route::resource('conditions', ConditionsController::class);
    Route::get('/conditions', [ConditionsController::class, 'index'])->name('conditions.index');
    Route::get('/conditions/search', [ConditionsController::class, 'search'])->name('conditions.search');
    Route::get('/conditions/create', [ConditionsController::class, 'create'])->name('conditions.create');
    Route::post('/conditions', [ConditionsController::class, 'store'])->name('conditions.store');

});

require __DIR__ . '/auth.php';
