<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidat_id',
        'candidature_id',
        'date_entretien',
        'lieu',
        'message',
        'statut',
    ];

    protected $casts = [
        'date_entretien' => 'datetime',
    ];

    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }
}
