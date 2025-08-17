@extends('recruteur.layout')

@section('content')
    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-calendar"></i> Entretiens</h2>
    </div>

    <div class="card shadow-sm p-3">
        <h5 class="mb-3">Liste des Entretiens</h5>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Candidat</th>
                        <th>Poste</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($entretiens as $entretien)
                        <tr>
                            <td>{{ $entretien->candidat->name }}</td>
                            <td>{{ $entretien->candidature->offre->titre }}</td>
                            <td>{{ $entretien->date_entretien->format('d/m/Y à H:i') }}</td>
                            <td>{{ $entretien->message ?? 'Aucun message' }}</td>
                            <td>
                                @if ($entretien->statut == 'planifié')
                                    <span class="badge bg-success">Planifié</span>
                                @else
                                    <span class="badge bg-secondary">Annulé</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucun entretien planifié</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
