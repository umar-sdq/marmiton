<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs'; 
    public $timestamps = true; 

    protected $fillable = [
        'nom',
        'identifiant',
        'mot_de_passe',
        'role',
    ];

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function username()
    {
        return 'identifiant';
    }

    public function recettes()
    {
        return $this->hasMany(Recette::class, 'utilisateur_id');
    }
}
