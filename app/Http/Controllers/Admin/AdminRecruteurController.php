<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    public function index()
    {
        $recruiters = Recruiter::all();
        return view('admin.recruteurs.index', compact('recruteurs'));
    }

    public function create()
    {
        return view('admin.recruteurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email'        => 'required|email|unique:recruiters,email',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string',
        ]);

        Recruiter::create($request->all());

        return redirect()->route('recruteurs.index')->with('success', 'Recruteur ajouté avec succès.');
    }

    public function edit(Recruiter $recruiter)
    {
        return view('admin.recruteurs.edit', compact('recruteur'));
    }

    public function update(Request $request, Recruiter $recruiter)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email'        => 'required|email|unique:recruiters,email,' . $recruiter->id,
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string',
            'status'       => 'required|in:active,inactive',
        ]);

        $recruiter->update($request->all());

        return redirect()->route('recruteurs.index')->with('success', 'Recruteur mis à jour.');
    }

    public function destroy(Recruiter $recruiter)
    {
        $recruiter->delete();
        return redirect()->route('recruteurs.index')->with('success', 'Recruteur supprimé.');
    }
}
