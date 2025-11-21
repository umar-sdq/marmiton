<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\IngredientController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apropos', function () {
    return view('apropos');
});

Route::get('/recettes/autocomplete', [RecetteController::class, 'autocomplete'])->name('recettes.autocomplete');

Route::resources([
    'utilisateurs' => UtilisateurController::class,
    'recettes' => RecetteController::class,
    'ingredients' => IngredientController::class,
]);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/recettes', [RecetteController::class, 'index'])
        ->name('admin.recettes.index');
});

Route::post('/language-switch', function (Illuminate\Http\Request $request) {
    $locale = $request->input('locale');
    if (in_array($locale, ['fr', 'en', 'es'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return back();
})->name('language.switch');
Route::get('{any}', function () {
    return view('monopage');
})->where('any', '.*');
