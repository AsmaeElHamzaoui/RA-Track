<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Clé étrangère vers l'utilisateur
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade'); // Clé étrangère vers le vol
            $table->integer('passenger_id'); // clé étrangère vers le passager
            $table->enum('class', ['economy', 'business', 'first'])->default('economy'); // Classe choisie
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
}
