<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EntretienPlanifie;
use App\Models\Candidature;
use App\Models\Entretien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminEntretienController extends Controller
{
    public function index()
    {
        $entretiens = Entretien::with(['candidat', 'candidature.offre'])->get();
        return view('admin.entretiens.index', compact('entretiens'));
    }

    public function create(Candidature $candidature)
    {
        return view('admin.entretiens.planifier', compact('candidature'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidat_id' => 'required|exists:users,id',
            'candidature_id' => 'required|exists:candidatures,id',
            'date_entretien' => 'required|date',
            'lieu' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $entretien = Entretien::create($request->all());

        // ✅ Envoi du mail au candidat
        Mail::to($entretien->candidat->email)->send(new EntretienPlanifie($entretien));

        return redirect()->route('admin.entretiens.index')->with('success', 'Entretien planifié avec succès !');
    }
}
