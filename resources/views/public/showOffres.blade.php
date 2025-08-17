@extends('public.layout')
@section('title', "Offres de l'entreprise " . $entreprise->nom)

@section('content')
    <section class="section-3 py-5 bg-2">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10">
                    <h2>{{ $entreprise->nom }} – Offres d'emploi</h2>
                    <p class="text-muted">{{ $entreprise->offres->count() }} offre(s) publiée(s)</p>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option value="">Récents</option>
                            <option value="">Anciens</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    {{-- ✅ Sidebar (filtres statiques pour l’instant, tu pourras les dynamiser plus tard) --}}
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Mots clés</h2>
                            <input type="text" placeholder="Keywords" class="form-control">
                        </div>
                        <div class="mb-4">
                            <h2>Adresse</h2>
                            <input type="text" placeholder="Location" class="form-control">
                        </div>
                        <div class="mb-4">
                            <h2>Secteur</h2>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                <option value="">Engineering</option>
                                <option value="">Accountant</option>
                                <option value="">Information Technology</option>
                                <option value="">Fashion designing</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <h2>Type de Travail</h2>
                            <div class="form-check mb-2">
                                <input class="form-check-input" name="job_type" type="checkbox" value="fulltime" id="fulltime">
                                <label class="form-check-label" for="fulltime">Full Time</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" name="job_type" type="checkbox" value="parttime" id="parttime">
                                <label class="form-check-label" for="parttime">Part Time</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" name="job_type" type="checkbox" value="freelance" id="freelance">
                                <label class="form-check-label" for="freelance">Freelance</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" name="job_type" type="checkbox" value="remote" id="remote">
                                <label class="form-check-label" for="remote">Remote</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ✅ Section dynamique des offres --}}
                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">

                                @forelse($offres as $offre)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4 h-100">
                                            <div class="card-body d-flex flex-column">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $offre->titre }}</h3>
                                                <p>{{ Str::limit($offre->description, 100) }}</p>

                                                <div class="bg-light p-3 border mt-auto">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $offre->lieu ?? 'Non précisé' }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $offre->type_contrat ?? 'Non spécifié' }}</span>
                                                    </p>
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('public.offreDetails', $offre->id) }}"
                                                       class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>Aucune offre disponible pour cette entreprise.</p>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
