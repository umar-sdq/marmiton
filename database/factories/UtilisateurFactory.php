<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UtilisateurFactory extends Factory
{
    protected $model = Utilisateur::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'identifiant' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'mot_de_passe' => bcrypt('password'), // mot de passe haché
            'role' => 'ADMIN',
            'remember_token' => Str::random(10), // si tu utilises ce champ
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
