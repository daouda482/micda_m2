@extends('layouts.app')
@section('title', 'Publier une Offre')

@section('content')
<h2 class="mb-4"><i class="fas fa-plus-circle"></i> Publier une Offre</h2>

<div class="card shadow-sm p-4">
    <form action="{{ route('admin.offres.store') }}" method="POST">
        @csrf

        {{-- Affichage des erreurs de validation --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Titre de l’offre <span class="text-danger fw-bold">*</span> </label>
                <input type="text" class="form-control" name="titre" value="{{ old('titre') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Type de contrat <span class="text-danger fw-bold">*</span></label>
                <select class="form-select" name="type_contrat" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="CDI" {{ old('type_contrat') == 'CDI' ? 'selected' : '' }}>CDI</option>
                    <option value="CDD" {{ old('type_contrat') == 'CDD' ? 'selected' : '' }}>CDD</option>
                    <option value="Stage" {{ old('type_contrat') == 'Stage' ? 'selected' : '' }}>Stage</option>
                    <option value="Freelance" {{ old('type_contrat') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Lieu <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" name="lieu" value="{{ old('lieu') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Date d'expiration</label>
                <input type="date" class="form-control" name="date_limite" value="{{ old('date_limite') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Entreprise <span class="text-danger fw-bold">*</span></label>
            <select class="form-select" name="entreprise_id" required>
                <option value="">-- Sélectionner l’entreprise --</option>
                @foreach($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}" {{ old('entreprise_id') == $entreprise->id ? 'selected' : '' }}>
                        {{ $entreprise->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description <span class="text-danger fw-bold">*</span></label>
            <textarea class="form-control" rows="5" name="description" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
        <a href="{{ route('admin.offres.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
    </form>
</div>
@endsection
