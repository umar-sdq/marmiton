<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    public $timestamps = true;

    protected $fillable = [
        'nom',
        'identifiant',
        'email',             
        'mot_de_passe',
        'role',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
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
