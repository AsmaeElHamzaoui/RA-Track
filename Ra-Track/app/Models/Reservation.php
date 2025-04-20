<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Clé étrangère vers l'utilisateur
        'flight_id', // Clé étrangère vers le vol
        'passenger_id', // Clé étrangère vers le passager
        'class', // Classe choisie (économy, business, first)
    ];

     /**
     * Relation N:1 avec l'entité User
     * Une réservation appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation N:1 avec l'entité Flight
     * Une réservation appartient à un vol.
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    /**
     * Relation 1:N avec l'entité Passenger
     * Une réservation peut avoir plusieurs passagers.
     */
    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'reservation_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


        public function getBasePriceForClass(): ?float
    {
        if (!$this->flight) {
            Log::error("Tentative de calcul de prix sans vol associé pour la réservation ID: {$this->id}");
            return null; // Impossible de calculer sans vol
        }

        switch (strtolower($this->class)) {
            case 'business':
                return (float) $this->flight->business_class_price;
            case 'first':
                return (float) $this->flight->first_class_price;
            case 'economy':
                // Utilise 'economy_class_price' qui existe dans ton FlightController
                return (float) $this->flight->economy_class_price;
            default:
                Log::warning("Classe inconnue '{$this->class}' pour la réservation ID: {$this->id}");
                return null; // Classe non reconnue
        }
    }

   
    public function getPriceForPassenger(Passenger $passenger): ?float
    {
        $basePrice = $this->getBasePriceForClass();

        if ($basePrice === null || $basePrice < 0) {
            // Le prix de base n'a pas pu être déterminé ou est invalide
             Log::error("Prix de base invalide ou non trouvé pour la classe '{$this->class}' sur vol ID {$this->flight_id}");
            return null;
        }

        // Appliquer la règle d'âge
        if ($passenger->age > 15) {
            // Adulte (ou jeune >= 16 ans) : plein tarif
            return $basePrice;
        } else {
            // Enfant (<= 15 ans) : moitié prix
            return $basePrice / 2;
        }
    }

    
    public function calculateTotalPrice(): ?float
    {
        if ($this->passengers->isEmpty()) {
             Log::warning("Tentative de calcul du prix total sans passagers pour la réservation ID: {$this->id}");
            return 0.0; // Ou null si tu préfères
        }

        $total = 0;
        foreach ($this->passengers as $passenger) {
            $passengerPrice = $this->getPriceForPassenger($passenger);

            if ($passengerPrice === null) {
                // Si on ne peut pas calculer le prix d'un seul passager, le total est invalide
                Log::error("Impossible de calculer le prix total car le prix du passager ID {$passenger->id} est indéterminé.");
                return null;
            }
            $total += $passengerPrice;
        }

        // Arrondir à 2 décimales à la fin
        return round($total, 2);
    }

    public function isConfirmed(): bool
    {
        // Vérifie simplement s'il existe au moins un paiement pour cette réservation.
        // 'exists()' est efficace car il ne charge pas les données du paiement.
        return $this->payments()->exists();
    }
}
