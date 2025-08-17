@extends('recruteur.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-list"></i> Mes Entreprises</h2>
    <a href="{{ route('recruteur.offres.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Nouvelle Entreprise
    </a>
</div>

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
                @foreach($entreprises as $entreprise)
                    <tr>
                        <th><img src="" alt=""></th>
                        <td>{{ $entreprise->nom }}</td>
                        <td>{{ $entreprise->secteur }}</td>
                        <td>{{ $entreprise->adresse }}</td>
                        <td>{{ $entreprise->site_web }}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Voir</a>
                            <a href="" class="btn btn-secondary btn-sm">Modifier</a>
                            <a href="" class="btn btn-danger btn-sm">Supprimer</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
