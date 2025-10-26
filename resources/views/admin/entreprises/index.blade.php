@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-list"></i> Mes Entreprises</h2>
    <a href="{{ route('admin.entreprises.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Nouvelle Entreprise
    </a>
</div>
@if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

<div class="card shadow-sm p-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nom de l'entreprise</th>
                    <th>Secteur</th>
                    <th>Adresse</th>
                    <th>Site web</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entreprises as $entreprise)
                    <tr>
                        <th><img src="" alt=""></th>
                        <td>{{ $entreprise->nom }}</td>
                        <td>{{ $entreprise->secteur }}</td>
                        <td>{{ $entreprise->adresse }}</td>
                        <td>{{ $entreprise->site_web }}</td>
                        <td>
                            <a href="{{ route('admin.entreprises.show', $entreprise->id) }}" class="btn btn-primary btn-sm">Voir</a>
                            <a href="{{ route('admin.entreprises.edit', $entreprise->id) }}" class="btn btn-secondary btn-sm">Modifier</a>
                            <form action="{{ route('admin.entreprises.destroy', $entreprise->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette entreprise ?')" title="Supprimer">
                                    Supprimer
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucune entreprise disponible pour le moment.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <ul class="d-flex justify-content-end align-items-center">
            {{ $entreprises->links() }}
        </ul>
    </div>

</div>
@endsection
