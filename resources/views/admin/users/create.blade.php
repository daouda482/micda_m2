@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


<h2>Ajouter un utilisateur</h2>
<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Prénom</label>
        <input type="text" name="prenom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Rôle</label>
        <select name="role" class="form-control" required>
            <option value="admin">Admin</option>
            <option value="recruteur">Recruteur</option>
            <option value="candidat">Candidat</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Adresse</label>
        <input type="text" name="adresse" class="form-control">
    </div>
    <div class="mb-3">
        <label>Téléphone</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="mb-3">
        <label>Photo</label>
        <input type="file" name="photo" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Enregistrer</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
