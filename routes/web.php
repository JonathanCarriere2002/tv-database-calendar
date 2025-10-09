<?php

// @author Jonathan Carrière
// @author Jonathan Carrière

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\CritiqueController;
use App\Http\Controllers\HoraireController;
use App\Http\Controllers\PersonnageController;
use App\Http\Controllers\PlateformeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoubleurController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

// Routes pour le chargement des calendriers
Route::post('/async/calendrier', [CalendrierController::class, "afficher"]);
Route::post('/async/horaires', [HoraireController::class, 'afficher']);

// Routes associées aux modèles Eloquent
Route::resource('accueil', AccueilController::class);
Route::resource('animes', AnimeController::class);
Route::resource('calendrier', CalendrierController::class);
Route::resource('critiques', CritiqueController::class);
Route::resource('doubleurs', DoubleurController::class);
Route::resource('personnages', PersonnageController::class);
Route::resource('plateformes', PlateformeController::class);

// Route pour la page d'accueil
Route::get('/', [AccueilController::class, 'index']);

// Routes nécessitantes une authentification et confirmation de l'adresse courriel
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['auth', 'verified']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['auth', 'verified']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware(['auth', 'verified']);
    Route::resource('horaires', HoraireController::class)->middleware(['auth', 'verified']);
    Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
});

require __DIR__.'/auth.php';
