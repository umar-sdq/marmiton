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
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'utilisateur_id' => 'required|exists:utilisateurs,id',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $recette = new Recette();
    $recette->titre = $request->titre;
    $recette->description = $request->description;
    $recette->utilisateur_id = $request->utilisateur_id;

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $name);
        $recette->photo = $name;
    }

    $recette->save();

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
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis');
        }

        $recette->titre = $request->titre;
        $recette->description = $request->description;
        $recette->utilisateur_id = $request->utilisateur_id;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $name);
            $recette->photo = $name;
        }

        $recette->save();
        return redirect()->route('recettes.index')->with('success', 'Recette modifiée avec succès');
    }

    public function destroy($id)
    {
        $recette = Recette::findOrFail($id);
        $recette->delete();
        return redirect()->route('recettes.index')->with('success', 'Recette supprimée avec succès');
    }
    public function autocomplete(Request $request)
{
    $term = $request->get('term');
    $recettes = Recette::where('titre', 'LIKE', '%' . $term . '%')->pluck('titre');

    return response()->json($recettes);
}

}
