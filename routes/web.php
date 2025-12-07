<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Contract routes
    Route::get('/contratos/novo', [App\Http\Controllers\ContractController::class, 'create'])->name('contracts.create');
    Route::post('/contratos', [App\Http\Controllers\ContractController::class, 'store'])->name('contracts.store');
    Route::get('/contratos', [App\Http\Controllers\ContractController::class, 'index'])->name('contracts.index');
    Route::get('/contratos/{contract}', [App\Http\Controllers\ContractController::class, 'show'])->name('contracts.show');
    Route::get('/contratos/{contract}/editar', [App\Http\Controllers\ContractController::class, 'edit'])->name('contracts.edit');
    Route::patch('/contratos/{contract}', [App\Http\Controllers\ContractController::class, 'update'])->name('contracts.update');
    Route::delete('/contratos/{contract}', [App\Http\Controllers\ContractController::class, 'destroy'])->name('contracts.destroy');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
