<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Entreprise;
use App\Models\Offre;
use Illuminate\Http\Request;


class CandidatController extends Controller
{
    public function create(Offre $offre)
    {
        // 1) Interdire de postuler à sa propre offre (si l'utilisateur possède l'entreprise de l'offre)
        if (auth()->user()->id === optional($offre->entreprise)->user_id) {
            return back()->with('error', "Vous ne pouvez pas postuler à votre propre offre.");
        }

        // 2) Vérifier date limite (si définie)
        if ($offre->date_limite && now()->toDateString() > $offre->date_limite->toDateString()) {
            return back()->with('error', "La date limite de candidature pour cette offre est dépassée.");
        }

        // 3) Empêcher de postuler deux fois
        $deja = Candidature::where('offre_id', $offre->id)
                ->where('candidat_id', auth()->id())
                ->exists();
        if ($deja) {
            return redirect()->route('public.mesOffres')
                ->with('info', 'Vous avez déjà postulé à cette offre.');
        }

        return view('public.postulerOffre', compact('offre'));
    }

    public function store(Request $request, Offre $offre)
    {
        // Gardes identiques que dans create
        if (auth()->user()->id === optional($offre->entreprise)->user_id) {
            return back()->with('error', "Vous ne pouvez pas postuler à votre propre offre.");
        }
        if ($offre->date_limite && now()->toDateString() > $offre->date_limite->toDateString()) {
            return back()->with('error', "La date limite de candidature est dépassée.");
        }

        // Validation
        $validated = $request->validate([
            'message'            => ['required','string','min:10'],
            'experience'         => ['nullable','string'],
            'competence'         => ['nullable','string'],
            'cv'                 => ['required','file','mimes:pdf,doc,docx','max:5120'], // 5 MB
            'lettre_motivation'  => ['nullable','file','mimes:pdf,doc,docx','max:5120'],
        ]);

        // Empêcher les doublons via la BD et aussi ici (plus UX)
        $exists = Candidature::where('offre_id',$offre->id)
                    ->where('candidat_id', auth()->id())
                    ->exists();
        if ($exists) {
            return redirect()->route('public.mesOffres')
                ->with('info', 'Vous avez déjà postulé à cette offre.');
        }

        // Uploads (storage/app/public/...)
        $cvPath = $request->file('cv')->store('candidatures/cv', 'public');
        $lettrePath = $request->file('lettre_motivation')
            ? $request->file('lettre_motivation')->store('candidatures/lettres', 'public')
            : null;

        // Création
        Candidature::create([
            'offre_id'          => $offre->id,
            'candidat_id'       => auth()->id(),
            'statut'            => 'en attente',
            'message'           => $validated['message'],
            'experience'        => $validated['experience'] ?? null,
            'competence'        => $validated['competence'] ?? null,
            'cv'                => $cvPath,
            'lettre_motivation' => $lettrePath,
        ]);

        return redirect()->route('public.mesOffres')
            ->with('success', 'Votre candidature a été envoyée avec succès !');
    }

    public function mesOffres()
    {
        $candidat = auth()->user(); // ton user connecté
        $candidatures = $candidat->candidatures()->with('offre')->latest()->get();

        return view('public.mesOffres', compact('candidatures', 'candidat'));
    }

}
