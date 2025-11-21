<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Recette;

class RecetteTest extends TestCase
{
    public function test_fillable()
    {
        $recette = new Recette();
        $this->assertEquals([
            'titre',
            'description',
            'utilisateur_id',
            'date_creation',
            'photo'
        ], $recette->getFillable());
    }
}
