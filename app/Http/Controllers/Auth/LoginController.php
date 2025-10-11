<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirection après connexion
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Utiliser "identifiant" au lieu de "email"
     */
    protected function username()
    {
        return 'identifiant';
    }

    /**
     * Rediriger selon le rôle de l’utilisateur
     */
    protected function authenticated($request, $user)
    {
        if ($user->role === 'ADMIN') {
            return redirect('/admin/recettes');
        }

        return redirect('/home');
    }
}
