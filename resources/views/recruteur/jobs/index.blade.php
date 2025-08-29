@extends('layouts.app')

@section('content')

{{-- Message de succès --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-list"></i> Mes Offres</h2>
    <a href="{{ route('recruteur.offres.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Publier une Offre
    </a>
</div>

<div class="card shadow-sm p-3">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Entreprise & Poste</th>
                    <th>Type</th>
                    <th>Lieu</th>
                    <th>Date Publication</th>
                    <th>Date Expiration</th>
                    <th>Candidats</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($offres as $offre)
                    <tr>
                        <td>
                            <strong>{{ $offre->titre }}</strong><br>
                            <small class="text-muted">{{ $offre->entreprise->nom }}</small>
                        </td>
                        <td>{{ $offre->type_contrat }}</td>
                        <td>{{ $offre->lieu }}</td>
                        <td><span class="badge bg-success">{{ $offre->created_at->format('d/m/Y') }}</span></td>
                        <td><span class="badge bg-danger">{{ $offre->date_limite->format('d/m/Y') }}</span></td>
                        <td>
                            <span class="badge bg-info">
                                {{ $offre->candidatures->count() ?? 0 }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('recruteur.offres.show', $offre->id) }}" class="btn btn-sm btn-success" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('recruteur.offres.edit', $offre->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('recruteur.offres.destroy', $offre->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette offre ?')" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-danger fw-bold">Aucune offre disponible pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
