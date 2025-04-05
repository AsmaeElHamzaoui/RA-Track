<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number')->unique(); // Flight number (unique)
            $table->foreignId('plane_id')->constrained('planes')->onDelete('cascade'); // Assigned plane to the flight
            $table->foreignId('departure_airport_id')->constrained('airports')->onDelete('cascade'); // Departure airport
            $table->foreignId('arrival_airport_id')->constrained('airports')->onDelete('cascade'); // Arrival airport
            $table->dateTime('departure_time'); // Scheduled departure time
            $table->dateTime('arrival_time'); // Scheduled arrival time
            $table->enum('status', ['scheduled', 'in_progress', 'cancelled', 'delayed', 'completed']); // Flight status :['programmé', 'en cours', 'annulé', 'retardé', 'terminé']);
            $table->float('economy_class_price'); // Economy class price
            $table->float('business_class_price'); // Business class price
            $table->float('first_class_price'); // First class price
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
