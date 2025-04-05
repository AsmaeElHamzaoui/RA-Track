<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Clé étrangère vers l'utilisateur
        'flight_id', // Clé étrangère vers le vol
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
}
