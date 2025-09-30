<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $table = 'recettes';

    public $timestamps = false;

    protected $fillable = [
        'titre',
        'description',
        'utilisateur_id',
        'date_creation'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'recette_id');
    }
}
