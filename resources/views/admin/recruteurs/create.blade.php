@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestion des Recruteurs</h1>
    <a href="{{ route('admin.recruteurs.create') }}" class="btn btn-primary mb-3">+ Ajouter Recruteur</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Entreprise</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recruiters as $rec)
            <tr>
                <td>{{ $rec->name }}</td>
                <td>{{ $rec->email }}</td>
                <td>{{ $rec->recruiter->company_name ?? '' }}</td>
                <td>{{ $rec->recruiter->phone ?? '' }}</td>
                <td>
                    <a href="{{ route('admin.recruteurs.edit', $rec->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.recruteurs.destroy', $rec->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce recruteur ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
