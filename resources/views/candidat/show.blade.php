@extends('admin.layout')

@section('content')
<h2>Détails du candidat</h2>

<div class="card mb-3">
    <div class="card-header">
        {{ $candidate->name }}
    </div>
    <div class="card-body">
        <p><strong>Email :</strong> {{ $candidate->email }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($candidate->status ?? 'pending') }}</p>
        <p><strong>Date d'inscription :</strong> {{ $candidate->created_at->format('d/m/Y H:i') }}</p>
    </div>
</div>

<a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
@endsection
