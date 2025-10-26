@extends('layouts.app')

@section('content')
<h2 class="mb-4"><i class="fas fa-plus-circle"></i> Ajouter une entreprise</h2>

<div class="card shadow-sm p-4">
    <form action="{{ route('recruteur.entreprises.store') }}" method="POST">
        @csrf

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
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Secteur</label>
                <input type="text" name="secteur" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Adresse</label>
                <input type="file" name="adresse" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Site web</label>
                <input type="text" name="site web" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>logo</label>
                <input type="text" name="logo" class="form-control">
            </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Enregistrer</button>
        <a href="{{ route('recruteur.entreprises.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
