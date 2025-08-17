<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'secteur',
        'description',
        'adresse',
        'site_web',
        'logo',
    ];

    // Relation : une entreprise appartient à un utilisateur (recruteur)
    public function recruteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation : une entreprise a plusieurs offres
    public function offres()
    {
        return $this->hasMany(Offre::class);
    }
}
