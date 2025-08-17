@extends('public.layout')
@section('title', 'Postuler un Offre')
@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('public.index') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Postuler à un offre</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            <img src="assets/images/avatar7.png" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 class="mt-3 pb-0">Daouda BA</h5>
                            <p class="text-muted mb-1 fs-6">Full Stack Developer</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                                    class="btn btn-primary">Modifier Photo</button>
                            </div>
                        </div>
                    </div>
                    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item d-flex justify-content-between p-3">
                                    <a href="">Paramètres compte</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{ route('public.offres') }}">Postuler à un offre</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{ route('public.mesOffres') }}">Mes Offres</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4 ">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Details de l'offre</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Titre<span class="req">*</span></label>
                                    <input type="text" placeholder="Titre" id="title" name="title"
                                        class="form-control">
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Secteur<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Selectionner un secteur</option>
                                        <option value="">Engineering</option>
                                        <option value="">Accountant</option>
                                        <option value="">Information Technology</option>
                                        <option value="">Fashion designing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Nature de l'offre<span class="req">*</span></label>
                                    <select class="form-select">
                                        <option>Temps Plein</option>
                                        <option>Temps Partiel</option>
                                        <option>Remote</option>
                                        <option>Freelance</option>
                                    </select>
                                </div>
                                 <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Adresse<span class="req">*</span></label>
                                    <input type="text" placeholder="location" id="location" name="Adresse"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">CV <span class="req">*</span><label>
                                    <input type="file" id="cv" name="cv" class="form-control">
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="">Lettre de Motivation</label>
                                    <input type="file" id="lettre_motivation" name="lettre_motivation" class="form-control">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="5"
                                    placeholder="Description"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Expériences</label>
                                <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5"
                                    placeholder="Expériences"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Compentences</label>
                                <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5"
                                    placeholder="Compétences"></textarea>
                            </div>

                        </div>
                        <div class="card-footer  p-4">
                            <button type="button" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>

                </div>
            </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-3">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
