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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            
            // Les liaisons avec la table users (Clés étrangères)
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('ouvrier_id')->constrained('users')->onDelete('cascade');
            
            // Informations de la réservation
            $table->date('date_rendez_vous');
            $table->string('creneau_horaire'); // Ex: "14:00 - 16:00" ou "Matin"
            $table->text('description_demande')->nullable(); // Ex: "Fuite d'eau dans la cuisine"
            
            // Statut de la demande
            $table->string('statut')->default('en_attente'); // en_attente, acceptee, refusee
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
