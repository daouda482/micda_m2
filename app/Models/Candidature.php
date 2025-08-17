<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'offre_id',
        'candidat_id',
        'statut',
        'message',
        'cv',
        'lettre_motivation',
    ];

    
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }
}
