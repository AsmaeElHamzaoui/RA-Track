<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_number',           // Numéro du vol
        'plane_id',                // ID de l'avion affecté
        'departure_airport_id',    // ID de l'aéroport de départ
        'arrival_airport_id',      // ID de l'aéroport d'arrivée
        'departure_time',          // Heure de départ
        'arrival_time',            // Heure d'arrivée
        'status',                  // Statut du vol
        'economy_class_price',     // Prix classe économique
        'business_class_price',    // Prix classe business
        'first_class_price',       // Prix classe première
    ];

   
    
}
