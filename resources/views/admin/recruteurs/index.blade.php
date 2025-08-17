@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fas fa-users"></i> Liste des Recruteurs</h2>
        <a href="{{ route('recruteurs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Entreprise</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Statut</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recruiters as $recruiter)
                <tr>
                    <td>{{ $recruiter->company_name }}</td>
                    <td>{{ $recruiter->contact_name }}</td>
                    <td>{{ $recruiter->email }}</td>
                    <td>{{ $recruiter->phone ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $recruiter->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($recruiter->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('recruteurs.edit', $recruiter) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('recruteurs.destroy', $recruiter) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce recruteur ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun recruteur trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
