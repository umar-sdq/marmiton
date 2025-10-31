<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ingredient;
use App\Models\Recette;
use App\Models\Utilisateur;

class IngredientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_affiche_liste_ingredients()
    {
        $user = Utilisateur::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/ingredients');
        $response->assertStatus(200);
        $response->assertViewIs('ingredients.index');
    }

    public function test_creation_ingredient_valide()
    {
        $user = Utilisateur::factory()->create();
        $recette = Recette::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post('/ingredients', [
            'nom' => 'Tomate',
            'liste_ingredients' => 'Sel, poivre',
            'recette_id' => $recette->id,
        ]);

        $response->assertRedirect('/ingredients');
        $this->assertDatabaseHas('ingredients', ['nom' => 'Tomate']);
    }
}
