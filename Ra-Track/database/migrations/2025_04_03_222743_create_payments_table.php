<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade'); // Clé étrangère vers la réservation
            $table->enum('payment_method', ['credit_card', 'paypal', 'bank_transfer', 'cash'])->default('credit_card'); // Méthode de paiement
            $table->timestamp('payment_date')->nullable(); // Date du paiement
            $table->string('transaction_id')->unique(); // Identifiant unique de la transaction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}
