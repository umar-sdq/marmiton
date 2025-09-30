<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecetteController extends Controller
{
    public function index()
    {
        $recettes = Recette::with('ingredients', 'utilisateur')->get();
        return view('recettes.index', compact('recettes'));
    }

    public function create()
    {
        $utilisateurs = Utilisateur::all();
        return view('recettes.create', compact('utilisateurs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required',
            'description' => 'required',
            'utilisateur_id' => 'required|exists:utilisateurs,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis');
        }

        Recette::create($request->all());
        return redirect()->route('recettes.index')->with('success', 'Recette ajoutée avec succès');
    }

    public function show($id)
    {
        $recette = Recette::with('ingredients', 'utilisateur')->findOrFail($id);
        return view('recettes.show', compact('recette'));
    }

    public function edit($id)
    {
        $recette = Recette::findOrFail($id);
        $utilisateurs = Utilisateur::all();
        return view('recettes.edit', compact('recette', 'utilisateurs'));
    }

    public function update(Request $request, Recette $recette)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required',
            'description' => 'required',
            'utilisateur_id' => 'required|exists:utilisateurs,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis');
        }

        $recette->update($request->all());
        return redirect()->route('recettes.index')->with('success', 'Recette modifiée avec succès');
    }

    public function destroy($id)
    {
        $recette = Recette::findOrFail($id);
        $recette->delete();
        return redirect()->route('recettes.index')->with('success', 'Recette supprimée avec succès');
    }
}
