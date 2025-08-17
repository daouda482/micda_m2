<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\Offre;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        // 🔥 Section 1 : Entreprises avec le nombre d'offres
        $selectEntreprises = Entreprise::all();

        // Récupère toutes les entreprises avec le nombre d'offres associées
        $entreprises = Entreprise::withCount('offres')->get();

        // 🔥 Section 2 : Offres récentes
        $offresRecentes = Offre::where('date_limite', '>=', now())
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // 🔥 Section 3 : Offres passées (> 30 jours) + possibilité de filtrer
        $query = Offre::query();

        if ($request->filled('keyword')) {
            $query->where('titre', 'like', '%' . $request->keyword . '%')
                ->orWhere('description', 'like', '%' . $request->keyword . '%');
        }

        // Filtre adresse via la relation entreprise
        if ($request->filled('adresse')) {
            $query->whereHas('entreprise', function ($q) use ($request) {
                $q->where('adresse', 'like', "%{$request->adresse}%");
            });
        }

        if ($request->filled('type_contrat')) {
            $query->whereIn('type_contrat', $request->type_contrat);
        }

        if ($request->filled('entreprise')) {
            $query->where('entreprise_id', $request->entreprise);
        }

        // 👉 Ici on utilise `date_limite`
        $offresPassees = $query->where('date_limite', '<', now())
            ->orderBy('date_limite', 'desc')
            ->paginate(9);

        return view('public.accueil', compact('entreprises', 'selectEntreprises', 'offresRecentes', 'offresPassees'));
    }

    public function show(Entreprise $entreprise)
    {
        $offres = $entreprise->offres()->latest()->get();
        return view('public.showOffres', compact('entreprise', 'offres'));
    }

    public function listeOffres(Request $request)
    {
        $query = Offre::with('entreprise'); // chargement relation entreprise

        // Filtre par mots-clés (titre ou description)
        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->keyword . '%')
                ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        // Filtre par adresse
        if ($request->filled('adresse')) {
            $query->whereHas('entreprise', function ($q) use ($request) {
                $q->where('adresse', 'like', "%{$request->adresse}%");
            });
        }

        // Filtre par entreprise
        if ($request->filled('entreprise_id')) {
            $query->where('entreprise_id', $request->entreprise_id);
        }

        // Filtre par type de contrat
        if ($request->filled('type_contrat')) {
            $query->whereIn('type_contrat', $request->type_contrat); // tableau de valeurs
        }

        // Trier par date (récents ou passées)
        if ($request->sort === 'passees') {
            $query->where('date_limite', '<', now())->orderBy('date_limite', 'asc');
        } else {
            $query->where('date_limite', '>=', now())->orderBy('date_limite', 'desc');
        }

        $offres = $query->paginate(6);

        // Liste des entreprises (pour le select)
        $entreprises = Entreprise::all();

        return view('public.offres', compact('offres', 'entreprises'));
    }

    public function offreDetails(Offre $offre)
    {
        return view('public.detailOffres', compact('offre'));
    }

    public function postulerOffre()
    {
        return view('public.postulerOffre');
    }

    public function mesOffres()
    {
        return view('public.mesOffres');
    }
}
