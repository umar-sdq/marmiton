<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class AdminUtilisateurSeeder extends Seeder
{
    public function run(): void
    {
        Utilisateur::updateOrCreate(
            ['identifiant' => 'admin'],
            [
                'nom' => 'Administrateur',
                'mot_de_passe' => Hash::make('marmiton'), 
                'role' => 'ADMIN'
            ]
        );
    }
}
