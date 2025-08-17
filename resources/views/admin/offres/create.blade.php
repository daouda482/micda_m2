@extends('admin.layout')

@section('content')
<h2>Ajouter une offre d'emploi</h2>
<form action="{{ route('admin.offers.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Titre</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="5" required></textarea>
    </div>
    <div class="mb-3">
        <label>Lieu</label>
        <input type="text" name="location" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Salaire</label>
        <input type="text" name="salary" class="form-control">
    </div>
    <div class="mb-3">
        <label>Statut</label>
        <select name="status" class="form-control" required>
            <option value="active">Actif</option>
            <option value="inactive">Inactif</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Enregistrer</button>
    <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
