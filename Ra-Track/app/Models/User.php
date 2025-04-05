<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Vérifie si l'utilisateur est un administrateur.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un pilote.
     */
    public function isPilot()
    {
        return $this->role === 'pilot';
    }

    /**
     * Vérifie si l'utilisateur est un agent de maintenance.
     */
    public function isMaintenanceAgent()
    {
        return $this->role === 'maintenanceagent';
    }

    /**
     * Vérifie si l'utilisateur est un client.
     */
    public function isClient()
    {
        return $this->role === 'client';
    }

   


}
