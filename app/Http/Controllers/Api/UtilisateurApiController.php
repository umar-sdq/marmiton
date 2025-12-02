<?php

namespace App\Http\Controllers\Api;

use App\Models\Utilisateur;
use App\Http\Controllers\Controller;

class UtilisateurApiController extends Controller
{
    public function index()
    {
        return response()->json(Utilisateur::all());
    }
}

