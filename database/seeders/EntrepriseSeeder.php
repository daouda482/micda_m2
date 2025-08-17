<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entreprise;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        Entreprise::create([
            'user_id' => 2,
            'nom' => 'Tech Solutions',
            'secteur' => 'Informatique',
            'adresse' => 'Dakar Plateau, Sénégal',
            'site_web' => 'https://techsolutions.sn',
            'logo' => 'logos/techsolutions.png',
        ]);

        Entreprise::create([
            'user_id' => 2,
            'nom' => 'Banque Nationale',
            'secteur' => 'Finance',
            'adresse' => 'Corniche Ouest, Dakar',
            'site_web' => 'https://banquenationale.sn',
            'logo' => 'logos/banquenationale.png',
        ]);

        Entreprise::create([
            'user_id' => 2,
            'nom' => 'Global Marketing',
            'secteur' => 'Marketing',
            'adresse' => 'Paris, France',
            'site_web' => 'https://globalmarketing.fr',
            'logo' => 'logos/globalmarketing.png',
        ]);
    }
}
