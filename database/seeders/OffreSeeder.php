<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offre;
use App\Models\Entreprise;

class OffreSeeder extends Seeder
{
    public function run(): void
    {
        $entreprise1 = Entreprise::where('nom', 'Tech Solutions')->first();
        $entreprise2 = Entreprise::where('nom', 'Banque Nationale')->first();
        $entreprise3 = Entreprise::where('nom', 'Global Marketing')->first();

        Offre::create([
            'entreprise_id' => $entreprise1->id,
            'titre' => 'Développeur Full Stack',
            'description' => 'Nous recherchons un développeur Laravel & React.',
            'lieu' => 'Dakar',
            'type_contrat' => 'CDI',
            'date_limite' => now()->addDays(30),
        ]);

        Offre::create([
            'entreprise_id' => $entreprise2->id,
            'titre' => 'Chargé de clientèle',
            'description' => 'Gestion de portefeuille client et conseil bancaire.',
            'lieu' => 'Dakar',
            'type_contrat' => 'CDD',
            'date_limite' => now()->addDays(20),
        ]);

        Offre::create([
            'entreprise_id' => $entreprise3->id,
            'titre' => 'Responsable Marketing Digital',
            'description' => 'Mise en place de campagnes digitales et SEO.',
            'lieu' => 'Paris',
            'type_contrat' => 'Stage',
            'date_limite' => now()->addDays(15),
        ]);
    }
}
