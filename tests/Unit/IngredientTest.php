<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Ingredient;
use App\Models\Recette;

class IngredientTest extends TestCase
{
    public function test_fillable()
    {
        $ingredient = new Ingredient();
        $this->assertEquals([
            'nom', 'recette_id', 'liste_ingredients'
        ], $ingredient->getFillable());
    }
}
