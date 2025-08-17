@extends('recruteur.layout')

@section('content')
<h2 class="mb-4"><i class="fas fa-edit"></i> Modifier une Offre</h2>

<div class="card shadow-sm p-4">
    <form action="{{ route('recruteur.offres.update', $offre->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Affichage des erreurs de validation --}}
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
                <label class="form-label">Titre de l’offre <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" name="titre" value="{{ old('titre', $offre->titre) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Type de contrat <span class="text-danger fw-bold">*</span></label>
                <select class="form-select" name="type_contrat" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach(['CDI','CDD','Stage','Freelance'] as $type)
                        <option value="{{ $type }}" {{ old('type_contrat', $offre->type_contrat) == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Lieu <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" name="lieu" value="{{ old('lieu', $offre->lieu) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Date d'expiration</label>
                <input type="date" class="form-control" name="date_limite" value="{{ old('date_limite', $offre->date_limite->format('Y-m-d')) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Entreprise <span class="text-danger fw-bold">*</span></label>
            <select class="form-select" name="entreprise_id" required>
                <option value="">-- Sélectionner l’entreprise --</option>
                @foreach($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}" {{ old('entreprise_id', $offre->entreprise_id) == $entreprise->id ? 'selected' : '' }}>
                        {{ $entreprise->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description <span class="text-danger fw-bold">*</span></label>
            <textarea class="form-control" rows="5" name="description" required>{{ old('description', $offre->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="{{ route('recruteur.offres.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </form>
</div>
@endsection
