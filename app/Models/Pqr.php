<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pqr extends Model
{
    use HasFactory;

    protected $table = 'pqrs';

    protected $fillable = [
        'pqr_date',
        'pqr_type',
        'pqr_methodnotify',
        'pqr_cause',
        'pqr_observation',
        'pqr_evidence',
        'user_id',
    ];

    /**
     * Relación con User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
