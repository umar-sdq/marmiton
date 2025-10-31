<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Recette;
use App\Models\Utilisateur;

class RecetteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_affiche_les_recettes()
    {
        $user = Utilisateur::factory()->create(['role' => 'ADMIN']);
        $this->actingAs($user);
        $response = $this->get('/recettes');
        $response->assertStatus(200);
        $response->assertViewIs('recettes.index');
    }

    public function test_creation_recette_valide()
    {
        $user = Utilisateur::factory()->create(['role' => 'ADMIN']);
        $this->actingAs($user);
        $data = [
            'titre' => 'Clafoutis',
            'description' => 'Step 1: ...'
        ];
        $response = $this->post('/recettes', $data);
        $response->assertRedirect('/recettes');
        $this->assertDatabaseHas('recettes', ['titre' => 'Clafoutis']);
    }
}
