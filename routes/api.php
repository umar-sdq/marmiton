<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;  
use App\Http\Controllers\Api\RecetteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json(['message' => 'Bienvenue sur l’API Marmiton !']);
});

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::controller(RecetteController::class)->group(function () {

    Route::get('recettes', 'index');
    Route::get('recettes/{id}', 'show');

    Route::post('recettes', 'store');
    Route::put('recettes/{id}', 'update');
    Route::delete('recettes/{id}', 'destroy');
});

