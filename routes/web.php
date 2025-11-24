<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;

Route::get('/recettes/autocomplete', [RecetteController::class, 'autocomplete'])
    ->name('recettes.autocomplete');

Route::get('/{any}', function () {
    return view('monopage');
})->where('any', '^(?!api).*$');
