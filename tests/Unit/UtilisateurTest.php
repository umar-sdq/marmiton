<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Utilisateur;

class UtilisateurTest extends TestCase
{
    public function test_fillable()
    {
        $utilisateur = new Utilisateur();
        $this->assertEquals([
            'nom',
            'identifiant',
            'email',             
            'mot_de_passe',
            'role',
        ], $utilisateur->getFillable());
    }
}
