<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Import this

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_identification',
        'user_name',
        'user_lastname',
        'user_email',
        'user_password',
        'user_rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_password', // Cambiado de password a user_password
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'verified_email' => 'datetime', // Añadido para email verificado
        'user_password' => 'hashed', // Cambiado de password a user_password
    ];

    /**
     * Relación con Pqr.
     */
    public function pqrs()
    {
        return $this->hasMany(Pqr::class, 'user_id', 'user_id');
    }
}
