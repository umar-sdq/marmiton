<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\IngredientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d’accueil
Route::get('/', function () {
    return view('welcome');
});

// Exemple de page statique
Route::get('/apropos', function () {
    return view('apropos');
});

// Création des routes avec resources
Route::resources([
    'utilisateurs' => UtilisateurController::class,
    'recettes'     => RecetteController::class,
    'ingredients'  => IngredientController::class,
]);

Route::get('/recettes/autocomplete', [RecetteController::class, 'autocomplete'])
    ->name('recettes.autocomplete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/recettes', [RecetteController::class, 'index'])->name('admin.recettes.index');
});