@extends('public.layout')

@section('title', 'Postuler à une offre')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('public.index') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('public.offres') }}">Offres</a></li>
                        <li class="breadcrumb-item active">Postuler à une offre</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            {{-- Sidebar (facultatif) --}}
            <div class="col-lg-3">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="s-body text-center mt-3">
                        <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width:150px;">
                        <h5 class="mt-3 pb-0">{{ auth()->user()->name ?? 'Mon profil' }}</h5>
                        <p class="text-muted mb-1 fs-6">Candidat</p>
                    </div>
                </div>
                <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3"><a href="#">Paramètres compte</a></li>
                            <li class="list-group-item p-3"><a href="{{ route('public.offres') }}">Voir les offres</a></li>
                            <li class="list-group-item p-3"><a href="{{ route('public.mesOffres') }}">Mes candidatures</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Formulaire --}}
            <div class="col-lg-9">
                <form action="{{ route('candidatures.store', $offre) }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow mb-4">
                    @csrf
                    <div class="card-body card-form p-4">
                        <h3 class="fs-4 mb-1">Détails de l'offre</h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="mb-2">Titre <span class="req">*</span></label>
                                <input type="text" class="form-control" value="{{ $offre->titre }}" readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="mb-2">Entreprise <span class="req">*</span></label>
                                <input type="text" class="form-control" value="{{ $offre->entreprise->nom ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="mb-2">Type de contrat <span class="req">*</span></label>
                                <input type="text" class="form-control" value="{{ $offre->type_contrat }}" readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="mb-2">Lieu <span class="req">*</span></label>
                                <input type="text" class="form-control" value="{{ $offre->lieu }}" readonly>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h3 class="fs-5 mb-3">Votre candidature</h3>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="mb-2">CV <span class="req">*</span></label>
                                <input type="file" id="cv" name="cv" class="form-control" required>
                                @error('cv') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="mb-2">Lettre de motivation (optionnel)</label>
                                <input type="file" id="lettre_motivation" name="lettre_motivation" class="form-control">
                                @error('lettre_motivation') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-2">Message <span class="req">*</span></label>
                            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Présentez brièvement votre candidature..." required>{{ old('message') }}</textarea>
                            @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="mb-2">Expériences (optionnel)</label>
                            <textarea class="form-control" name="experience" id="experience" rows="5" placeholder="Vos expériences pertinentes...">{{ old('experience') }}</textarea>
                            @error('experience') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="mb-2">Compétences (optionnel)</label>
                            <textarea class="form-control" name="competence" id="competence" rows="5" placeholder="Vos compétences clés...">{{ old('competence') }}</textarea>
                            @error('competence') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="card-footer p-4">
                        <button type="submit" class="btn btn-primary">Envoyer ma candidature</button>
                        <a href="{{ route('public.offres') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection
