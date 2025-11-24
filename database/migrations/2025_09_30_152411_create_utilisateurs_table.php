<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateursTable extends Migration
{
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('identifiant')->unique();
            $table->string('email')->unique();
            $table->string('mot_de_passe');

            // REQUIRED FOR AUTH
            $table->timestamp('email_verified_at')->nullable();

            // REQUIRED FOR ROLES
            $table->string('role')->default('USER');

            // Laravel auth requirement
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
}
