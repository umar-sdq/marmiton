<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'recette_id',
        'liste_ingredients'
    ];

    public function recette()
    {
        return $this->belongsTo(Recette::class, 'recette_id');
    }
}
