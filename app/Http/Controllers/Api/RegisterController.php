<?php

namespace App\Http\Controllers\Api;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    /**
     * REGISTER API
     * Enregistre un nouvel utilisateur et retourne un token Sanctum.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'identifiant' => 'required|unique:utilisateurs,identifiant',
            'email' => 'required|email|unique:utilisateurs',
            'mot_de_passe' => 'required|min:6',
            'confirmation_mot_de_passe' => 'required|same:mot_de_passe',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erreur de validation.', $validator->errors());
        }

        // Création du nouvel utilisateur
        $input = $request->all();
        $input['mot_de_passe'] = Hash::make($input['mot_de_passe']);
        $utilisateur = Utilisateur::create($input);

        // Création du token Sanctum
        $success['token'] = $utilisateur->createToken('MarmitonToken')->plainTextToken;
        $success['nom'] = $utilisateur->nom;

        return $this->sendResponse($success, 'Utilisateur enregistré avec succès.');
    }

    /**
     * LOGIN API
     * Authentifie un utilisateur et retourne un token Sanctum.
     */
   public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'identifiant' => 'required',
        'mot_de_passe' => 'required',
    ]);

    if ($validator->fails()) {
        return $this->sendError('Erreur de validation.', $validator->errors());
    }

    // On récupère l'utilisateur par son identifiant
    $utilisateur = Utilisateur::where('identifiant', $request->identifiant)->first();

    // Vérifie si le compte existe et si le mot de passe correspond
    if (!$utilisateur || !Hash::check($request->mot_de_passe, $utilisateur->mot_de_passe)) {
        return $this->sendError('Identifiants invalides.', ['error' => 'Unauthorized']);
    }

    // Création du token Sanctum
    $success['token'] = $utilisateur->createToken('MarmitonToken')->plainTextToken;
    $success['nom'] = $utilisateur->nom;

    return $this->sendResponse($success, 'Connexion réussie.');
}

}
