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

   
}
