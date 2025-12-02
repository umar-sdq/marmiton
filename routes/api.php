<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;  
use App\Http\Controllers\Api\RecetteController;
use App\Models\Utilisateur;

Route::get('utilisateurs', function () {
    return Utilisateur::all();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('recettes', [RecetteController::class, 'store']);
    Route::put('recettes/{id}', [RecetteController::class, 'update']);
    Route::delete('recettes/{id}', [RecetteController::class, 'destroy']);
});

Route::get('recettes', [RecetteController::class, 'index']);
Route::get('recettes/{id}', [RecetteController::class, 'show']);

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::get('/', function () {
    return response()->json(['message' => 'Bienvenue sur l’API Marmiton !']);
});
