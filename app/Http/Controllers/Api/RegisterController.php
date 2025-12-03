<?php

namespace App\Http\Controllers\Api;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Http;

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
        'g-recaptcha-response' => 'required'
    ]);

    if ($validator->fails()) {
        return $this->sendError('Erreur de validation.', $validator->errors());
    }
    \Log::info('env test = ' . env('APP_ENV'));
\Log::info('recaptcha secret = ' . env('RECAPTCHA_SECRET_KEY'));


    $captcha = Http::asForm()->post(
        'https://www.google.com/recaptcha/api/siteverify',
        [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request['g-recaptcha-response']
        ]
    )->json();

    if (!($captcha['success'] ?? false)) {
        return response()->json(['error' => 'Captcha invalide'], 400);
    }

    $input = $request->all();
    $input['mot_de_passe'] = Hash::make($input['mot_de_passe']);
    $input['role'] = $request->role ?? 'USER';

    $user = Utilisateur::create($input);

    $success['token'] = $user->createToken('MarmitonToken')->plainTextToken;
    $success['role'] = $user->role;

    return $this->sendResponse($success, "Compte créé !");
}

    /**
     * autocomplete 
     * Recherche de recettes par titre pour l'autocomplétion
     */




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

    $utilisateur = Utilisateur::where('identifiant', $request->identifiant)->first();

    if (!$utilisateur || !Hash::check($request->mot_de_passe, $utilisateur->mot_de_passe)) {
        return $this->sendError('Identifiants invalides.', ['error' => 'Unauthorized']);
    }

    $success['token'] = $utilisateur->createToken('MarmitonToken')->plainTextToken;
    $success['nom'] = $utilisateur->nom;
    $success['role'] = $utilisateur->role;   

    return $this->sendResponse($success, 'Connexion réussie.');
}


}
