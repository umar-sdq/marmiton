<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;

// Routes Laravel normales
Route::get('/recettes/autocomplete', [RecetteController::class, 'autocomplete'])
    ->name('recettes.autocomplete');

// NE TOUCHE PAS AUX ROUTES API ICI

// SPA - DOIT ÊTRE EN DERNIER
Route::view('/{path}', 'monopage')->where('path', '^(?!api).*$');

