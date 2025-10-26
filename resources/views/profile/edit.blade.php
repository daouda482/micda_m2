@extends('layouts.app')
@section('title', 'Mon Profil')

@section('content')
<div class="container py-5">
    <!-- En-tête -->
    <div class="mb-5 text-center">
        <h1 class="fw-bold text-primary">Mon Profil</h1>
        <p class="text-muted">Gérez vos informations personnelles, votre mot de passe et votre compte.</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="row g-4">
        <!-- Informations personnelles -->
        <div class="col-lg-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 text-primary"><i class="bi bi-person-circle me-2"></i>Informations personnelles</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input id="name" name="name" type="text" class="form-control"
                                value="{{ old('name', auth()->user()->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input id="prenom" name="prenom" type="text" class="form-control"
                                value="{{ old('prenom', auth()->user()->prenom) }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input id="email" name="email" type="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input id="adresse" name="adresse" type="text" class="form-control"
                                value="{{ old('adresse', auth()->user()->adresse) }}">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input id="phone" name="phone" type="text" class="form-control"
                                value="{{ old('phone', auth()->user()->phone) }}">
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo de profil</label>
                            <input id="photo" name="photo" type="file" class="form-control">
                            @if(auth()->user()->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                         alt="Photo de profil" class="rounded-circle" width="80" height="80">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle</label>
                            <input id="role" type="text" class="form-control"
                                value="{{ ucfirst(auth()->user()->role) }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="account_status" class="form-label">Statut du compte</label>
                            <input id="account_status" type="text" class="form-control"
                                value="{{ ucfirst(auth()->user()->account_status) }}" disabled>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Changement du mot de passe -->
        <div class="col-lg-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 text-primary"><i class="bi bi-shield-lock me-2"></i>Changer le mot de passe</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input id="current_password" name="current_password" type="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input id="password" name="password" type="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning">Changer le mot de passe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Suppression du compte -->
        <div class="col-12">
            <div class="card border-0 shadow rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Supprimer le compte</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Une fois votre compte supprimé, toutes vos données seront définitivement effacées.
                        Cette action est <strong>irréversible</strong>.
                    </p>

                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement votre compte ?')">
                                Supprimer mon compte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
