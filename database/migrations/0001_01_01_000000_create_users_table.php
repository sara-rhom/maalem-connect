<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // --- NOS AJOUTS POUR LE PROJET ---
            $table->string('role')->default('client'); // client, ouvrier, ou admin
            $table->string('telephone')->nullable();
            $table->string('ville')->nullable();       // Ex: Kénitra, Rabat, Casablanca...
            $table->string('metier')->nullable();      // Ex: Électricien, Peintre... (uniquement pour les ouvriers)
            $table->text('tarifs')->nullable();        // Description des prix/prestations
            $table->string('statut_validation')->default('en_attente'); // en_attente, valide, rejete (pour l'admin)
            // ---------------------------------
    
            $table->rememberToken();
            $table->timestamps(); // Crée automatiquement 'created_at' et 'updated_at'
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
