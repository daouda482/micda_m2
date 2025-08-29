@extends('layouts.app')

@section('content')

<h2 class="mb-4"><i class="fas fa-edit"></i> Ajouter un utilisateur</h2>
<div class="card shadow-sm p-4">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <div class="row mb-3">
            <div class="col-md-6">
                <label>Prénom</label>
                <input type="text" name="prenom" value="{{ $user->prenom }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Nom</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Téléphone</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Adresse</label>
                <input type="text" name="adresse" value="{{ $user->adresse }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Rôle</label>
                <select name="role" class="form-control" required>
                    <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                    <option value="recruteur" {{ $user->role=='recruteur'?'selected':'' }}>Recruteur</option>
                    <option value="candidat" {{ $user->role=='candidat'?'selected':'' }}>Candidat</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
