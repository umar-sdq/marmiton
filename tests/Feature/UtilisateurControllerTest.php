<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Utilisateur;

class UtilisateurControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_affiche_liste_utilisateurs()
    {
        $user = Utilisateur::factory()->create(['role' => 'ADMIN']);
        $this->actingAs($user);
        $response = $this->get('/utilisateurs');
        $response->assertStatus(200);
        $response->assertViewIs('utilisateurs.index');
    }

    public function test_creation_utilisateur_valide()
    {
        $admin = Utilisateur::factory()->create(['role' => 'ADMIN']);
        $this->actingAs($admin);
        $data = [
            'nom' => 'Bob',
            'identifiant' => 'bob2025',
            'mot_de_passe' => '1234'
        ];
        $response = $this->post('/utilisateurs', $data);
        $response->assertRedirect('/utilisateurs');
        $this->assertDatabaseHas('utilisateurs', ['nom' => 'Bob']);
    }
}
