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

  
}
