@extends('admin.layout')

@section('content')
<h2>Gestion des offres d'emploi</h2>
<a href="{{ route('admin.offers.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Ajouter une offre</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Lieu</th>
            <th>Salaire</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($offers as $offer)
        <tr>
            <td>{{ $offer->id }}</td>
            <td>{{ $offer->title }}</td>
            <td>{{ $offer->location }}</td>
            <td>{{ $offer->salary ?? 'N/A' }}</td>
            <td>{{ ucfirst($offer->status) }}</td>
            <td>
                <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
