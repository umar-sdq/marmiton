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
        if (auth()->user()->role === "ADMIN") {
            $recettes = Recette::all();
        } else {
            $recettes = Recette::where('utilisateur_id', auth()->id())->get();
        }

        return view('recettes.index', compact('recettes'));
    }

    public function create()
    {
        $utilisateurs = auth()->user()->role === 'ADMIN'
            ? Utilisateur::all()
            : collect([auth()->user()]);

        return view('recettes.create', compact('utilisateurs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
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

        if (auth()->user()->role === 'ADMIN' && $request->has('utilisateur_id')) {
            $recette->utilisateur_id = $request->utilisateur_id;
        } else {
            $recette->utilisateur_id = auth()->id();
        }

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
        $recette = Recette::findOrFail($id);

        if (auth()->user()->role !== 'ADMIN' && $recette->utilisateur_id !== auth()->id()) {
            abort(403, 'Accès refusé');
        }

        return view('recettes.show', compact('recette'));
    }

    public function edit($id)
    {
        $recette = Recette::findOrFail($id);

        if (auth()->user()->role !== 'ADMIN' && $recette->utilisateur_id !== auth()->id()) {
            abort(403, 'Accès refusé');
        }

        $utilisateurs = auth()->user()->role === 'ADMIN'
            ? Utilisateur::all()
            : collect([auth()->user()]);

        return view('recettes.edit', compact('recette', 'utilisateurs'));
    }

    public function update(Request $request, $id)
    {
        $recette = Recette::findOrFail($id);

        if (auth()->user()->role !== 'ADMIN' && $recette->utilisateur_id !== auth()->id()) {
            abort(403, 'Accès refusé');
        }

        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis');
        }

        $recette->titre = $request->titre;
        $recette->description = $request->description;

        if (auth()->user()->role === 'ADMIN' && $request->has('utilisateur_id')) {
            $recette->utilisateur_id = $request->utilisateur_id;
        }

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

        if (auth()->user()->role !== 'ADMIN' && $recette->utilisateur_id !== auth()->id()) {
            abort(403, 'Accès refusé');
        }

        $recette->delete();

        return redirect()->route('recettes.index')->with('success', 'Recette supprimée avec succès');
    }

    public function autocomplete(Request $request)
    {
        $term = $request->get('term', '');
        $recettes = Recette::where('titre', 'LIKE', '%' . $term . '%')
            ->take(10)
            ->get(['id', 'titre']);

        $results = [];
        foreach ($recettes as $recette) {
            $results[] = ['id' => $recette->id, 'value' => $recette->titre];
        }

        return response()->json($results);
    }
}
