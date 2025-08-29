<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    protected $fillable = [
        'entreprise_id',
        'titre',
        'description',
        'lieu',
        'type_contrat',
        'date_limite',
    ];

    protected $casts = [
        'date_limite' => 'datetime',
    ];

    // Une offre appartient à une entreprise
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class);
    }

}
