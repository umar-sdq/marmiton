<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs'; 

    public $timestamps = false; 

    protected $fillable = [
        'nom',
        'identifiant',
        'mot_de_passe',
        'date_creation'
    ];

  
    public function recettes()
    {
        return $this->hasMany(Recette::class, 'utilisateur_id');
    }
}
