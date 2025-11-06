<?php

namespace App\Http\Controllers\Api;

use App\Models\Recette;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class RecetteController extends BaseController
{
    public function index()
    {
        $recettes = Recette::all();
        return $this->sendResponse($recettes, 'Liste des recettes récupérée avec succès.');
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($validator->fails()) {
        return $this->sendError('Erreur de validation.', $validator->errors());
    }

    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('recettes', 'public');
    }

    $recette = Recette::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'photo' => $photoPath,
        'utilisateur_id' => auth()->id(),
    ]);

    return $this->sendResponse($recette, 'Recette créée avec succès.');
}


    public function update(Request $request, $id)
    {
        $recette = Recette::find($id);
        if (!$recette) {
            return $this->sendError('Recette introuvable.');
        }

        $recette->update($request->all());
        return $this->sendResponse($recette, 'Recette mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $recette = Recette::find($id);
        if (!$recette) {
            return $this->sendError('Recette introuvable.');
        }

        $recette->delete();
        return $this->sendResponse([], 'Recette supprimée avec succès.');
    }
}
