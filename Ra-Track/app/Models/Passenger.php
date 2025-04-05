<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id', // Clé étrangère vers la réservation
        'name',           // Nom du passager
        'age',            // Âge du passager
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
