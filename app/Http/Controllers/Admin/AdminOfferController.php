<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;

class AdminOfferController extends Controller {
    public function index() {
        $offers = Offer::with('creator')->get();
        return view('admin.offres.index', compact('offres'));
    }

    public function create() {
        return view('admin.offres.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'location'=>'nullable',
            'status'=>'required|in:active,inactive'
        ]);
        Offer::create(array_merge($request->all(), ['created_by'=>auth()->id()]));
        return redirect()->route('offres.index')->with('success','Offre créée avec succès');
    }

    public function edit(Offer $offer) {
        return view('admin.offres.edit', compact('offre'));
    }

    public function update(Request $request, Offer $offer) {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'location'=>'nullable',
            'status'=>'required|in:active,inactive'
        ]);
        $offer->update($request->all());
        return redirect()->route('offres.index')->with('success','Offre mise à jour avec succès');
    }

    public function destroy(Offer $offer) {
        $offer->delete();
        return redirect()->route('offres.index')->with('success','Offre supprimée');
    }
}
