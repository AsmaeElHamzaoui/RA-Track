<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade'); // Clé étrangère vers la réservation
            $table->string('firstname'); // Nom du passager
            $table->string('lastname'); // Prénom du passenger
            $table->integer('age')->nullable(); // Âge du passager
            $table->string('gender')->nullable(); // Sexe du passager
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
}
