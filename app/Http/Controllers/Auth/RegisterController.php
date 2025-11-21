<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Utilisateur;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirection après inscription
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validation des données du formulaire
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'identifiant' => ['required', 'string', 'max:255', 'unique:utilisateurs'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:utilisateurs'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Création de l'utilisateur après validation
     */
    protected function create(array $data)
    {
        return Utilisateur::create([
            'nom' => $data['nom'],
            'identifiant' => $data['identifiant'],
            'email' => $data['email'],
            'mot_de_passe' => Hash::make($data['password']),
            'role' => 'USER',
        ]);
    }

    protected function registered(Request $request, $user)
{
    return redirect()->route('verification.notice');
}
}
