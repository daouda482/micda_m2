<?php

namespace App\Http\Controllers\Recruteur;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Entreprise;
use App\Models\Entretien;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruteurController extends Controller
{
    public function index()
    {
        $offresCount = Offre::count();
        $candidaturesCount = Candidature::count();
        $entretiensCount = Entretien::count();

        return view('recruteur.dashbord', compact('offresCount', 'candidaturesCount', 'entretiensCount'));

    }

    public function listeEntreprises()
    {
        // Récupérer les entreprises associées à l'utilisateur connecté
        $entreprises = Entreprise::where('user_id', Auth::id())->get();

        return view('recruteur.entreprises.index', compact('entreprises'));
    }

}
