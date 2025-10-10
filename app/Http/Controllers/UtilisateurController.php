<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::all();
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function create()
    {
        return view('utilisateurs.create');
    }

    public function store(Request $request)
{
    $messages = [
        'nom.required' => 'Le nom est obligatoire.',
        'identifiant.required' => 'L’identifiant est obligatoire.',
        'identifiant.unique' => 'Cet identifiant est déjà utilisé.',
        'mot_de_passe.required' => 'Le mot de passe est obligatoire.',
        'mot_de_passe.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
    ];

    $validated = $request->validate([
        'nom'          => 'required|string|max:255',
        'identifiant'  => 'required|string|max:255|unique:utilisateurs,identifiant',
        'mot_de_passe' => 'required|string|min:4',
    ], $messages);

    $utilisateur = new \App\Models\Utilisateur();
    $utilisateur->nom = $validated['nom'];
    $utilisateur->identifiant = $validated['identifiant'];
    $utilisateur->mot_de_passe = bcrypt($validated['mot_de_passe']);
    $utilisateur->save();

    return redirect()->route('utilisateurs.index')
                     ->with('success', 'Utilisateur ajouté avec succès.');
}




    public function show($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.show', compact('utilisateur'));
    }

    public function edit($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.edit', compact('utilisateur'));
    }

    public function update(Request $request, Utilisateur $utilisateur)
    {
        $validator = Validator::make($request->all(), [
            'nom'          => 'required|string|max:255',
            'identifiant'  => 'required|string|max:255|unique:utilisateurs,identifiant,' . $utilisateur->id,
            'mot_de_passe' => 'required|string|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Tous les champs sont requis');
        }

        $utilisateur->update($request->all());
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur modifié avec succès');
    }

    public function destroy($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
