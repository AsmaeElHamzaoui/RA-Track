<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration',
        'model',
        'manufacturer',
        'airline_company', // Nom de la compagnie aérienne (manuellement rempli)
        'economy_class_capacity',
        'business_class_capacity',
        'first_class_capacity',
        'maximum_load',
        'flight_range',
        'status',
    ];

    
}

