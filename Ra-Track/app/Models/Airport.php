<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_iata', // Code IATA de l'aéroport
        'name',      // Nom de l'aéroport
        'location',  // Emplacement de l'aéroport
    ];

    /**
     * Relation 1:N avec Flight (Aéroport de départ)
     * Un aéroport peut être l'aéroport de départ de plusieurs vols.
     */
    public function departures()
    {
        return $this->hasMany(Flight::class, 'departure_airport_id');
    }

    /**
     * Relation 1:N avec Flight (Aéroport d'arrivée)
     * Un aéroport peut être l'aéroport d'arrivée de plusieurs vols.
     */
    public function arrivals()
    {
        return $this->hasMany(Flight::class, 'arrival_airport_id');
    }
}
