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
        'pilot_id', 
    ];

     /**
     * Relation N:1 avec l'entité Plane
     * Un vol est affecté à un avion.
     */
    public function plane()
    {
        return $this->belongsTo(Plane::class, 'plane_id');
    }

    /**
     * Relation N:1 avec l'entité Airport (Aéroport de départ)
     * Un vol part d'un aéroport de départ.
     */
    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    /**
     * Relation N:1 avec l'entité Airport (Aéroport d'arrivée)
     * Un vol arrive dans un aéroport d'arrivée.
     */
    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }
    
    /**
     * Relation N:1 avec l'entité User (Pilote du vol)
     * Un vol est affecté à un pilote.
     */
    // public function pilot()
    // {
    //     return $this->belongsTo(User::class, 'user_id')->where('role', 'pilot');
    // }
    
}
