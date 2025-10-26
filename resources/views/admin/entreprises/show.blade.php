@extends('layouts.app')
@section('title', 'Détail de l\'entreprise')

@section('content')
<h2 class="mb-4"><i class="fas fa-eye"></i> Détail de l'entreprise</h2>

<div class="card shadow-sm p-4">

    <div class="mb-3">
        <label class="form-label fw-bold">Entreprise :</label>
        <p class="form-control-plaintext">{{ $entreprise->nom }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Secteur :</label>
        <p class="form-control-plaintext">{{ $entreprise->secteur }}</p>
    </div>

     <div class="mb-3">
        <label class="form-label fw-bold">Adresse :</label>
        <p class="form-control-plaintext">{{ $entreprise->adresse }}</p>
    </div>

     <div class="mb-3">
        <label class="form-label fw-bold">Site Web :</label>
        <p class="form-control-plaintext">{{ $entreprise->site_web}}</p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Date de création :</label>
        <p class="form-control-plaintext">{{ $entreprise->created_at->format('d/m/Y') }}</p>
    </div>

    <a href="{{ route('admin.entreprises.edit', $entreprise->id) }}" class="btn btn-warning">
        <i class="fas fa-edit"></i> Modifier
    </a>
    &nbsp;
    <a href="{{ route('admin.entreprises.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
</div>
@endsection
