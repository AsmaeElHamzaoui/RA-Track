<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightReport extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'flight_id',
        'comment',
        'report_path',
    ];

    /**
     * Get the flight that owns the report.
     * Defines the inverse of the one-to-one relationship.
     */
    public function flight(): BelongsTo
    {
        // A FlightReport belongs to one Flight
        return $this->belongsTo(Flight::class);
    }
}