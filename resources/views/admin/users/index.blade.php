@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<h2>Liste des utilisateurs</h2>
<a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Ajouter un utilisateur</a>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Prénom et Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>
                <img src="" alt="photo" class="rounded-circle" style="width: 50px; height: 50px;">
            </td>
            <td>{{ $user->prenom }} {{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone ?? 'N/A' }}</td>
            <td>{{ $user->adresse ?? 'N/A' }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
