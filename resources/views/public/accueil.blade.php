@extends('public.layout')
@section('title', 'Accueil')
@section('content')
    <section class="section-0 lazy d-flex bg-image-style dark align-items-center " class=""
        data-bg="{{ asset('assets/images/banner5.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <h1>Trouvez l'emploi de vos rêves</h1>
                    <p>Des milliers d'emplois disponibles.</p>
                    <div class="banner-btn mt-5"><a href="{{ route('public.offres') }}" class="btn btn-primary mb-4 mb-sm-0">Explorer Maintenant</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-1 py-5 ">
        <div class="container">
            <form method="GET" action="{{ route('public.index') }}" class="card border-0 shadow p-5">
                <div class="row">
                    <!-- Mots clés -->
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Mots clés">
                    </div>

                    <!-- Adresse -->
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="adresse" value="{{ request('adresse') }}"
                            placeholder="Adresse">
                    </div>

                    <!-- Entreprise -->
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="entreprise_id" class="form-control" onchange="this.form.submit()">
                            <option value="">Toutes les entreprises</option>
                            @foreach ($selectEntreprises as $selectEntreprise)
                                <option value="{{ $selectEntreprise->id }}"
                                    {{ request('entreprise_id') == $selectEntreprise->id ? 'selected' : '' }}>
                                    {{ $selectEntreprise->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bouton -->
                    <div class="col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Rechercher</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>Entreprises</h2>
            <div class="row pt-5">

                @foreach ($entreprises as $entreprise)
                    <div class="col-lg-4 col-xl-3 col-md-6 mb-4">
                        <div class="single_catagory">
                            <a href="{{ route('entreprises.show', $entreprise->id) }}">
                                <h4 class="pb-2">{{ $entreprise->nom }}</h4>
                            </a>
                            <p class="mb-0">
                                <span>{{ $entreprise->offres_count }}</span> offres disponibles
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


    <section class="section-3  py-5">
        <div class="container">
            <h2>Offres en cours</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @forelse ($offresRecentes as $offre)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="fs-5">{{ $offre->titre }}</h3>
                                            <p class="text-muted">{{ $offre->entreprise->nom }}</p>
                                            <div class="bg-light p-3 border">
                                                <p class="mb-0"><i class="fa fa-map-marker"></i>
                                                    {{ $offre->lieu }}</p>
                                                <p class="mb-0"><i class="fa fa-clock-o"></i> {{ $offre->type_contrat }}
                                                </p>
                                                <p class="mb-0">Expire: <span
                                                        class="text-muted fw-bold">{{ $offre->date_limite->format('d/m/Y') }}</span>
                                                </p>
                                            </div>
                                            <div class="d-grid mt-3">
                                                <a href="{{ route('public.offreDetails', $offre->id) }}"
                                                    class="btn btn-primary btn-lg">Détails</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Aucune Offre pour le moment</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Offres Passées</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @forelse ($offresPassees as $offre)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="fs-5">{{ $offre->titre }}</h3>
                                            <p class="text-muted">{{ $offre->entreprise->nom }}</p>
                                            <div class="bg-light p-3 border">
                                                <p class="mb-0"><i class="fa fa-map-marker"></i>
                                                    {{ $offre->entreprise->adresse }}</p>
                                                <p class="mb-0"><i class="fa fa-clock-o"></i> {{ $offre->type_contrat }}
                                                </p>
                                                <p class="mb-0">Expire: <span
                                                        class="text-muted fw-bold">{{ $offre->date_limite->format('d/m/Y') }}</span>
                                                </p>

                                            </div>
                                            <div class="d-grid mt-3">
                                                <a href="{{ route('public.offreDetails', $offre->id) }}"
                                                    class="btn btn-primary btn-lg">Détails</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Aucune Offre pour le moment</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
