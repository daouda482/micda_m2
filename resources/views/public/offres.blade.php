@extends('public.layout')
@section('title', 'Offres d\'emploi')
@section('content')

    <section class="section-3 py-5 bg-2">
        <div class="container">
            <form method="GET" action="{{ route('public.offres') }}">
                <div class="row">
                    <div class="col-6 col-md-10">
                        <h2>Trouver un Job</h2>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                            <option value="recents" {{ request('sort') == 'recents' ? 'selected' : '' }}>Récents</option>
                            <option value="passees" {{ request('sort') == 'passees' ? 'selected' : '' }}>Passées</option>
                        </select>
                    </div>
                </div>

                <div class="row pt-5">
                    <!-- Filtres -->
                    <div class="col-md-4 col-lg-3 sidebar mb-4">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <h2>Mots clés</h2>
                                <input type="text" name="keyword" value="{{ request('keyword') }}"
                                    placeholder="Mots clés" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Adresse</h2>
                                <input type="text" name="adresse" value="{{ request('adresse') }}" placeholder="Adresse"
                                    class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Entreprises</h2>
                                <select name="entreprise_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">Toutes</option>
                                    @foreach ($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}"
                                            {{ request('entreprise_id') == $entreprise->id ? 'selected' : '' }}>
                                            {{ $entreprise->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <h2>Type de contrat</h2>
                                @foreach (['CDD', 'CDI', 'Freelance', 'Stage'] as $type)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" name="type_contrat[]" type="checkbox"
                                            value="{{ $type }}"
                                            {{ in_array($type, (array) request('type_contrat')) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $type }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                        </div>
                    </div>

                    <!-- Résultats -->
                    <div class="col-md-8 col-lg-9">
                        <div class="row">
                            @forelse($offres as $offre)
                                <div class="col-md-10 col-lg-4 mb-4 d-flex">
                                    <div class="card border-0 p-3 shadow w-100 h-100 d-flex flex-column">
                                        <div class="card-body d-flex flex-column">
                                            <h3 class="fs-5 text-truncate" title="{{ $offre->titre }}">{{ $offre->titre }}
                                            </h3>
                                            <p class="text-muted">{{ $offre->entreprise->nom }}</p>
                                            <div class="bg-light p-3 border rounded flex-grow-1">
                                                <p class="mb-2"><i class="fa fa-map-marker"></i>
                                                    {{ $offre->entreprise->adresse }}</p>
                                                <p class="mb-2"><i class="fa fa-clock-o"></i> {{ $offre->type_contrat }}
                                                </p>
                                                <p class="mb-0">
                                                    <span
                                                        class="{{ $offre->date_limite->isPast() ? 'text-danger fw-bold' : 'text-success fw-bold' }}">
                                                        Expire: {{ $offre->date_limite->format('d/m/Y') }}
                                                    </span>
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
                                <p>Aucune offre trouvée.</p>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $offres->links() }}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
