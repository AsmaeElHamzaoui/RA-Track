<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Unique identifier for the plane (UUID)
            $table->string('registration')->unique();  // immatruculation
            $table->string('model'); // Model of the plane (e.g., Airbus A320)
            $table->string('manufacturer'); // Manufacturer of the plane (e.g., Airbus, Boeing)
            $table->string('airline_company'); // Airline company the plane belongs to
            $table->integer('economy_class_capacity');  // Passenger capacity in economy class
            $table->integer('business_class_capacity'); // Passenger capacity in business class
            $table->integer('first_class_capacity'); // Passenger capacity in first class 
            $table->float('maximum_load'); // la masse maximal (in kilograms)
            $table->integer('flight_range'); // Maximum flight range of the plane (in kilometers) (distance de vol en Km)
            $table->enum('status', ['active', 'under maintenance', 'out of service']); // Status of the plane (active, under maintenance, or out of service)
            $table->timestamps(); // Timestamps for record creation and updates
        });
    }

    public function down(): void
    {
        // Drops the planes table if it exists
        Schema::dropIfExists('planes');
    }
};

