<?php

namespace App\Http\Controllers\Recruteur;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    /**
     * Affiche toutes les offres de l’entreprise du recruteur connecté
     */
    public function index()
    {
        $offres = Offre::with('entreprise')->latest()->get();

        return view('recruteur.jobs.index', compact('offres'));
    }

    /**
     * Formulaire de création d'une nouvelle offre
     */
    public function create()
    {
        $entreprises = Entreprise::all(); // utile si plusieurs entreprises
        return view('recruteur.jobs.create', compact('entreprises'));
    }

    /**
     * Enregistre une nouvelle offre
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'lieu' => 'required|string|max:255',
            'type_contrat' => 'required|string',
            'date_limite' => 'nullable|date',
            'entreprise_id' => 'required|exists:entreprises,id',
        ]);

        Offre::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'lieu' => $request->lieu,
            'type_contrat' => $request->type_contrat,
            'date_limite' => $request->date_limite,
            'entreprise_id' => $request->entreprise_id,
            'created_at' => now(),
        ]);

        return redirect()->route('recruteur.offres.index')
                         ->with('success', 'Offre créée avec succès');
    }

    /**
     * Formulaire d'édition d'une offre
     */
    public function edit($id)
    {
        $offre = Offre::findOrFail($id);
        $entreprises = Entreprise::all();

        return view('recruteur.jobs.edit', compact('offre', 'entreprises'));
    }

    /**
     * Met à jour une offre
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'lieu' => 'required|string|max:255',
            'type_contrat' => 'required|string',
            'date_limite' => 'nullable|date',
            'entreprise_id' => 'required|exists:entreprises,id',
        ]);

        $offre = Offre::findOrFail($id);
        $offre->update($request->all());

        return redirect()->route('recruteur.offres.index')
                         ->with('success', 'Offre mise à jour avec succès');
    }

    /**
     * Affiche les détails d'une offre
     */
    public function show($id)
    {
        $offre = Offre::with('entreprise')->findOrFail($id);
        return view('recruteur.jobs.show', compact('offre'));
    }

    /**
     * Supprime une offre
     */
    public function destroy($id)
    {
        $offre = Offre::findOrFail($id);
        $offre->delete();

        return redirect()->route('recruteur.offres.index')
                         ->with('success', 'Offre supprimée avec succès');
    }
}
