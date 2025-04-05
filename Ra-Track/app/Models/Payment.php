<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',  // Clé étrangère vers la réservation
        'payment_method',  // Méthode de paiement
        'payment_date',    // Date du paiement
        'transaction_id',  // Identifiant de la transaction
    ];

    
}
