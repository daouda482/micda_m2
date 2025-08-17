<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Offre;
use App\Models\Candidature;

class CandidatureSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer un utilisateur existant avec le rôle candidat
        $candidat = User::where('role', 'candidat')->first();

        if (!$candidat) {
            $this->command->info('Aucun utilisateur candidat trouvé. Veuillez en créer un.');
            return;
        }

        // Récupérer 3 offres d'exemple pour tester
        $offres = Offre::take(3)->get();

        foreach ($offres as $index => $offre) {
            Candidature::create([
                'candidat_id' => $candidat->id,
                'offre_id' => $offre->id,
                'cv' => "cvs/cv_test{$index}.pdf",
                'lettre_motivation' => "lettres/lettre_test{$index}.pdf",
                'message' => "Message de candidature pour l'offre {$offre->id}",
                'statut' => 'en attente', // statut initial
            ]);
        }
    }
}
