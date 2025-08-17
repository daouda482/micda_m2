@extends('admin.layout')

@section('content')
<h2>Détails du recruteur</h2>

<div class="card mb-3">
    <div class="card-header">
        {{ $recruiter->name }}
    </div>
    <div class="card-body">
        <p><strong>Email :</strong> {{ $recruiter->email }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($recruiter->status ?? 'active') }}</p>
        <p><strong>Date d'inscription :</strong> {{ $recruiter->created_at->format('d/m/Y H:i') }}</p>
    </div>
</div>

<a href="{{ route('admin.recruiters.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
@endsection
