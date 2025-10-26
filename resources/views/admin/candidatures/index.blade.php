@extends('layouts.app')

@section('content')
    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="mb-4"><i class="fas fa-users"></i> Candidatures Reçues</h2>

    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nom Candidat</th>
                        <th>Email</th>
                        <th>Poste</th>
                        <th>Date</th>
                        <th>CV</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($candidatures as $candidature)
                        <tr>
                            <td>{{ $candidature->candidat->prenom ?? '' }} {{ $candidature->candidat->name ?? '' }}</td>
                            <td>{{ $candidature->candidat->email ?? 'N/A' }}</td>
                            <td>{{ $candidature->offre->titre ?? 'N/A' }}</td>
                            <td>{{ $candidature->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if ($candidature->cv)
                                    <a href="{{ asset('storage/' . $candidature->cv) }}" target="_blank"
                                        class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> Voir
                                    </a>
                                @else
                                    <span class="text-muted">Pas de CV</span>
                                @endif
                            </td>
                            <td>
                                @if ($candidature->statut == 'en attente')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($candidature->statut == 'accepte')
                                    <span class="badge bg-success">Acceptée</span>
                                @elseif($candidature->statut == 'en cours')
                                    <span class="badge bg-info">En traitement</span>
                                @elseif($candidature->statut == 'refuse')
                                    <span class="badge bg-danger">Rejetée</span>
                                @endif
                            </td>
                            <td>
                                @if ($candidature->statut === 'en attente')
                                    {{-- Bouton accepter --}}
                                    <form action="{{ route('admin.candidatures.accept', $candidature->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir accepter cette candidature ?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Accepter">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    {{-- Bouton rejeter --}}
                                    <form action="{{ route('admin.candidatures.reject', $candidature->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette candidature ?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" title="Rejeter">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.candidatures.show', $candidature->id) }}"
                                        class="btn btn-sm btn-secondary" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                @elseif($candidature->statut === 'accepte')
                                    {{-- Bouton planifier entretien --}}
                                    <a href="{{ route('admin.entretiens.planifier', $candidature->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-calendar-plus"></i> Planifier
                                    </a>

                                     <a href="{{ route('admin.candidatures.show', $candidature->id) }}"
                                        class="btn btn-sm btn-secondary" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                @elseif($candidature->statut === 'refuse')
                                    {{-- Bouton voir détails --}}
                                    <a href="{{ route('admin.candidatures.show', $candidature->id) }}"
                                        class="btn btn-sm btn-secondary" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucune candidature reçue.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
