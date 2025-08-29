@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="mb-4"><i class="fas fa-info-circle"></i> Détails de la candidature</h3>

    <div class="mb-3">
        <strong>Nom du candidat :</strong>  {{ $candidature->candidat->prenom }} {{ $candidature->candidat->name }}
    </div>

    <div class="mb-3">
        <strong>Email :</strong> {{ $candidature->candidat->email }}
    </div>

     <div class="mb-3">
        <strong>Téléphone :</strong> {{ $candidature->candidat->phone ?? 'N/A' }}
    </div>

    <div class="mb-3">
        <strong>Entreprise :</strong> {{ $candidature->offre->entreprise->name ?? 'N/A' }}
    </div>

    <div class="mb-3">
        <strong>Date de candidature :</strong> {{ $candidature->created_at->format('Y-m-d') }}
    </div>

    <div class="mb-3">
        <strong>Poste postulé :</strong> {{ $candidature->offre->titre }}
    </div>

    <div class="mb-3">
        <strong>Message :</strong>
        <p>{{ $candidature->message }}</p>
    </div>

    <div class="mb-3">
        <strong>CV :</strong>
        <a href="{{ asset($candidature->cv) }}" target="_blank" class="btn btn-sm btn-info">
            <i class="fas fa-file-pdf"></i> Voir CV
        </a>
    </div>

    <div class="mb-3">
        <strong>Lettre de motivation :</strong>
        <a href="{{ asset($candidature->lettre_motivation) }}" target="_blank" class="btn btn-sm btn-info">
            <i class="fas fa-file-pdf"></i> Voir Lettre
        </a>
    </div>

    <div class="mb-3">
        <strong>Statut :</strong>
        @if($candidature->statut === 'en attente')
            <span class="badge bg-warning">En attente</span>
        @elseif($candidature->statut === 'accepte')
            <span class="badge bg-success">Acceptée</span>
        @elseif($candidature->statut === 'en cours')
            <span class="badge bg-info">En traitement</span>
        @else
            <span class="badge bg-danger">Rejetée</span>
        @endif
    </div>

    <a href="{{ route('recruteur.candidatures.index') }}" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>
@endsection
