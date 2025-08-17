@extends('public.layout')
@section('title', 'Détails de l\'offre')

@section('content')
<section class="section-4 bg-2">
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('public.offres') }}">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                &nbsp;Retourner à la page offres
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container job_details_area">
        <div class="row pb-5">
            {{-- Partie principale --}}
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="jobs_conetent">
                                    <h4>{{ $offre->titre }}</h4>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p><i class="fa fa-map-marker"></i> {{ $offre->lieu }}</p>
                                        </div>
                                        <div class="location">
                                            <p><i class="fa fa-clock-o"></i> {{ $offre->type_contrat }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="descript_wrap white-bg p-3">
                        <div class="single_wrap">
                            <h4>Description de l'offre</h4>
                            <p>{{ $offre->description }}</p>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                            <a href="{{ route('public.postulerOffre', $offre->id) }}" class="btn btn-primary">Postuler</a>
                            <a href="{{ route('public.offres') }}" class="btn btn-danger">Annuler</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Résumé de l’offre --}}
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Résumé de l'offre</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Publié le: <span>{{ $offre->created_at->format('d M Y') }}</span></li>
                                <li>Expire le: <span>{{ $offre->date_limite->format('d M Y') }}</span></li>
                                <li>Expérience: <span>{{ $offre->experience ?? 'Non précisé' }}</span></li>
                                <li>Adresse: <span>{{ $offre->lieu }}</span></li>
                                <li>Contrat: <span>{{ $offre->type_contrat }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Informations entreprise --}}
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Détails Entreprise</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Nom: <span>{{ $offre->entreprise->nom ?? 'Non spécifié' }}</span></li>
                                <li>Adresse: <span>{{ $offre->entreprise->adresse ?? 'Non spécifiée' }}</span></li>
                                <li>Secteur: <span>{{ $offre->entreprise->secteur ?? 'Non spécifiée' }}</span></li>
                                <li>Site web:
                                    <span>
                                        <a href="{{ $offre->entreprise->site_web ?? '#' }}" target="_blank">
                                            {{ $offre->entreprise->site_web ?? 'Non spécifié' }}
                                        </a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
