<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id', // Clé étrangère vers la réservation
        'firstname',           // Nom du passager
        'lastname',
        'age',            // Âge du passager
        'seat_number',    // Numéro de siège
        'gender',         // Sexe du passager
    ];

    
    /**
     * Relation N:1 avec l'entité Reservation
     * Un passager appartient à une réservation.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
