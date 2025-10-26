@extends('layouts.app')

@section('content')
<h2 class="mb-4"><i class="fas fa-edit"></i> Modifier une entreprise</h2>

<div class="card shadow-sm p-4">
    <form action="{{ route('admin.entreprises.update', $entreprise->id) }}" method="POST" enctype="multipart/form-data">
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
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ old('nom', $entreprise->nom) }}" required>
            </div>
            <div class="col-md-6">
                <label>Secteur</label>
                <input type="text" name="secteur" class="form-control" value="{{ old('secteur', $entreprise->secteur) }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $entreprise->adresse) }}" required>
            </div>
            <div class="col-md-6">
                <label>Site web</label>
                <input type="text" name="site_web" class="form-control" value="{{ old('site_web', $entreprise->site_web) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
                @if($entreprise->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $entreprise->logo) }}" alt="Logo" height="50">
                    </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button>
        <a href="{{ route('admin.entreprises.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
