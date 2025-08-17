<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminCandidateController extends Controller
{
    // Liste de tous les candidats
    public function index()
    {
        $candidates = User::where('role', 'candidat')->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    // Afficher un candidat spécifique
    public function show(User $candidate)
    {
        return view('admin.candidates.show', compact('candidate'));
    }

    // Mettre à jour le statut d'un candidat (ex: accepté ou rejeté)
    public function updateStatus(Request $request, User $candidate)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $candidate->update(['status' => $request->status]);

        return redirect()->route('admin.candidates.index')->with('success', 'Statut mis à jour avec succès');
    }
}

