<?php

namespace App\Http\Controllers\Api;

use App\Models\Recette;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class RecetteController extends BaseController
{
    /**
     * LISTE DES RECETTES
     * - Utilisateur normal → uniquement SES recettes
     * - ADMIN → toutes les recettes
     */
    public function index()
    {
        if (auth()->user()->role === 'ADMIN') {
            $recettes = Recette::with('ingredients')->get();
        } else {
            $recettes = Recette::where('utilisateur_id', auth()->id())
                ->with('ingredients')
                ->get();
        }

        return response()->json($recettes);
    }

    /**
     * CRÉATION DE RECETTE
     */
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

    /**
     * AFFICHER UNE RECETTE
     * - User ne peut voir que les siennes
     * - Admin peut tout voir
     */
    public function show($id)
    {
        $query = Recette::with('ingredients')->where('id', $id);

        if (auth()->user()->role !== 'ADMIN') {
            $query->where('utilisateur_id', auth()->id());
        }

        $recette = $query->first();

        if (!$recette) {
            return response()->json(['error' => 'Accès interdit'], 403);
        }

        return response()->json($recette);
    }

    /**
     * UPDATE
     * - User ne peut modifier que les siennes
     */
    public function update(Request $request, $id)
{
    $recette = Recette::find($id);

    if (!$recette) {
        return response()->json(['error' => 'Recette introuvable'], 404);
    }

    // ADMIN peut tout modifier
    if (auth()->user()->role !== 'ADMIN' &&
        $recette->utilisateur_id !== auth()->id()) 
    {
        return response()->json(['error' => 'Accès interdit'], 403);
    }

    $recette->update($request->all());

    return $this->sendResponse($recette, 'Recette mise à jour avec succès.');
}


    /**
     * DELETE
     * - User ne peut supprimer que les siennes
     */
    public function destroy($id)
{
    $recette = Recette::find($id);

    if (!$recette) {
        return response()->json(['error' => 'Recette introuvable'], 404);
    }

    // ADMIN peut tout supprimer
    if (auth()->user()->role !== 'ADMIN' &&
        $recette->utilisateur_id !== auth()->id()) 
    {
        return response()->json(['error' => 'Accès interdit'], 403);
    }

    $recette->delete();

    return $this->sendResponse([], 'Recette supprimée avec succès.');
}

}
