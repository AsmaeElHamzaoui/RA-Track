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

    /**
     * Relation N:1 avec l'entité Reservation
     * Un paiement appartient à une réservation.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    
    /**
     * Calcul du montant du paiement basé sur le prix de la réservation
     * Ceci est utile si le montant est récupéré automatiquement à partir de la réservation.
     */
    public function getAmountAttribute()
    {
        return $this->reservation->price;  // On suppose que `price` est un attribut de la table `reservations`
    }
}
