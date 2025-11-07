<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inscription', [AuthController::class, 'showInscription'])->name('inscription');
Route::post('/inscription', [AuthController::class, 'inscription']);

Route::get('/connexion', [AuthController::class, 'showConnexion'])->name('login');
Route::post('/connexion', [AuthController::class, 'connexion']);

Route::post('/deconnexion', [AuthController::class, 'deconnexion'])->name('deconnexion');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [IdeaController::class, 'index'])->name('dashboard');
    Route::get('/ideas/create', [IdeaController::class, 'create'])->name('ideas.create');
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');
    Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update');
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy');
});
