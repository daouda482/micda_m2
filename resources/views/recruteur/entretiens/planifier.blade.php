@extends('recruteur.layout')

@section('content')
<div class="card shadow-sm p-3 mb-4">
    <h5 class="mb-3">Planifier un Entretien</h5>
    <form action="{{ route('recruteur.entretiens.store', $candidature->id) }}" method="POST">
        @csrf
        <input type="hidden" name="candidat_id" value="{{ $candidature->candidat->id }}">
        <input type="hidden" name="candidature_id" value="{{ $candidature->id }}">

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Candidat</label>
                <input type="text" class="form-control" value="{{ $candidature->candidat->prenom }} {{ $candidature->candidat->name }}" disabled>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date & Heure</label>
                <input type="datetime-local" class="form-control" name="date_entretien" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" class="form-control" name="lieu" placeholder="Ex: Salle 101 ou Dakar Plateau">
        </div>
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea class="form-control" name="message" rows="3" placeholder="Ex: Merci de vous présenter 10 minutes avant l'entretien."></textarea>
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Enregistrer</button>
        
    </form>
</div>
@endsection
