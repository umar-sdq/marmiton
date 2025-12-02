<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        return Ingredient::with('recette')->get();
    }

    public function show($id)
    {
        return Ingredient::with('recette')->findOrFail($id);
    }

    public function store(Request $request)
    {
        return Ingredient::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->all());
        return $ingredient;
    }

    public function destroy($id)
    {
        Ingredient::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted']);
    }
}
