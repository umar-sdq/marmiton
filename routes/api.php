<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;  
use App\Http\Controllers\Api\RecetteController;
use App\Http\Controllers\Api\IngredientController;
use App\Models\Utilisateur;

/*
|--------------------------------------------------------------------------
| INGREDIENTS (public GET, protected POST/PUT/DELETE)
|--------------------------------------------------------------------------
*/

Route::get('ingredients', [IngredientController::class, 'index']);
Route::get('ingredients/{id}', [IngredientController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('ingredients', [IngredientController::class, 'store']);
    Route::put('ingredients/{id}', [IngredientController::class, 'update']);
    Route::delete('ingredients/{id}', [IngredientController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| UTILISATEURS
|--------------------------------------------------------------------------
*/

Route::get('utilisateurs', function () {
    return Utilisateur::all();
});

/*
|--------------------------------------------------------------------------
| RECETTES (public GET, protected POST/PUT/DELETE)
|--------------------------------------------------------------------------
*/

Route::get('recettes', [RecetteController::class, 'index']);
Route::get('recettes/{id}', [RecetteController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('recettes', [RecetteController::class, 'store']);
    Route::put('recettes/{id}', [RecetteController::class, 'update']);
    Route::delete('recettes/{id}', [RecetteController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnecté']);
    });
});

/*
|--------------------------------------------------------------------------
| WELCOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return response()->json(['message' => 'Bienvenue sur l’API Marmiton !']);
});
