<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use App\Models\Entretien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminCandidatureController extends Controller
{
    // Afficher toutes les candidatures reçues
    public function index()
    {
        $candidatures = Candidature::with('candidat', 'offre')->get();
        return view('admin.candidatures.index', compact('candidatures'));
    }

    // Accepter une candidature
    public function accept($id)
    {
        $candidature = Candidature::findOrFail($id);
        $candidature->statut = 'accepte';
        $candidature->save();

        // Exemple d'envoi de mail (à adapter)
        Mail::raw("Votre candidature a été acceptée !", function($message) use ($candidature){
            $message->to($candidature->candidat->email)
                    ->subject("Candidature acceptée");
        });

        return redirect()->route('admin.candidatures.index')->with('success', 'Candidature acceptée et mail envoyé.');
    }

    // Afficher les détails d'une candidature
    public function show($id)
    {
        $candidature = Candidature::with(['candidat', 'offre'])->findOrFail($id);

        return view('admin.candidatures.show', compact('candidature'));
    }

    // Rejeter une candidature
    public function reject($id)
    {
        $candidature = Candidature::findOrFail($id);
        $candidature->statut = 'refuse';
        $candidature->save();

        // Exemple d'envoi de mail
        Mail::raw("Votre candidature a été rejetée.", function($message) use ($candidature){
            $message->to($candidature->candidat->email)
                    ->subject("Candidature rejetée");
        });

        return redirect()->route('admin.candidatures.index')->with('success', 'Candidature rejetée et mail envoyé.');
    }

    // Planifier un entretien (à compléter après création table entretien)
    public function planifierEntretien(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'heure' => 'required',
            'lieu' => 'required|string|max:255',
        ]);

        $candidature = Candidature::findOrFail($id);

        // Créer l'entretien
        Entretien::create([
            'candidature_id' => $candidature->id,
            'date' => $request->date,
            'heure' => $request->heure,
            'lieu' => $request->lieu,
        ]);

        return redirect()->route('admin.candidatures.index')->with('success', 'Entretien planifié avec succès.');
    }
}
