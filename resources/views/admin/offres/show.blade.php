@extends('layouts.app')
@section('title', 'Détail de l\'Offre')

@section('content')
<h2 class="mb-4"><i class="fas fa-eye"></i> Détail de l'Offre</h2>

<div class="card shadow-sm p-4">
    <div class="mb-3">
        <label class="form-label fw-bold">Titre de l’offre :</label>
        <p class="form-control-plaintext">{{ $offre->titre }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Type de contrat :</label>
        <p class="form-control-plaintext">{{ $offre->type_contrat }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Lieu :</label>
        <p class="form-control-plaintext">{{ $offre->lieu }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Entreprise :</label>
        <p class="form-control-plaintext">{{ $offre->entreprise->nom }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Date de publication :</label>
        <p class="form-control-plaintext">{{ $offre->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Date limite :</label>
        <p class="form-control-plaintext">{{ $offre->date_limite->format('d/m/Y') }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Description :</label>
        <p class="form-control-plaintext">{{ $offre->description }}</p>
    </div>

    <a href="{{ route('admin.offres.edit', $offre->id) }}" class="btn btn-warning">
        <i class="fas fa-edit"></i> Modifier
    </a>
    &nbsp;
    <a href="{{ route('admin.offres.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
</div>
@endsection
