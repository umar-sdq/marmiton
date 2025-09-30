<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::with('recette')->get();
        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        $recettes = Recette::all();
        return view('ingredients.create', compact('recettes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom'              => 'required|string|max:255',
            'liste_ingredients'=> 'required|string',
            'recette_id'       => 'required|exists:recettes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis');
        }

        Ingredient::create($request->all());
        return redirect()->route('ingredients.index')->with('success', 'Ingrédient ajouté avec succès');
    }

    public function show($id)
    {
        $ingredient = Ingredient::with('recette')->findOrFail($id);
        return view('ingredients.show', compact('ingredient'));
    }

    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $recettes = Recette::all();
        return view('ingredients.edit', compact('ingredient', 'recettes'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validator = Validator::make($request->all(), [
            'nom'              => 'required|string|max:255',
            'liste_ingredients'=> 'required|string',
            'recette_id'       => 'required|exists:recettes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis');
        }

        $ingredient->update($request->all());
        return redirect()->route('ingredients.index')->with('success', 'Ingrédient modifié avec succès');
    }

    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('success', 'Ingrédient supprimé avec succès');
    }
}
