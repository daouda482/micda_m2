<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer les entreprises associées à l'utilisateur connecté
        $entreprises = Entreprise::latest()->paginate(10);

        return view('admin.entreprises.index', compact('entreprises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.entreprises.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'          => ['nullable','exists:users,id'],
            'nom'         => ['required','string','max:255'],
            'secteur'     => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
            'adresse'     => ['nullable','string','max:255'],
            'siteweb'    => ['nullable','url','max:255'],
            'logo'        => ['nullable','image','mimes:jpg,jpeg,png,gif','max:2048'], // 2 MB
        ]);

        // Gérer le téléchargement du logo si fourni
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        // Associer l'entreprise à l'utilisateur connecté (recruteur)
        $validated['user_id'] = auth()->id();

        Entreprise::create($validated);

        return redirect()->route('admin.entreprises.index')
                         ->with('success', 'Entreprise créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        return view('admin.entreprises.show', compact('entreprise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entreprise $entreprise)
    {
        return view('admin.entreprises.edit', compact('entreprise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $entreprise = Entreprise::findOrFail($id);

        $validated = $request->validate([
            'user_id'          => ['nullable','exists:users,id'],
            'nom'         => ['required','string','max:255'],
            'secteur'     => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
            'adresse'     => ['nullable','string','max:255'],
            'site_web'    => ['nullable','url','max:255'],
            'logo'        => ['nullable','image','mimes:jpg,jpeg,png,gif','max:2048'], // 2 MB
        ]);

        // Gérer le téléchargement du logo si fourni
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        $entreprise->update($validated);

        return redirect()->route('admin.entreprises.index')
                         ->with('success', 'Entreprise mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();

        return redirect()->route('admin.entreprises.index')
                         ->with('success', 'Entrprise supprimée avec succès');
    }
}
