@extends('layouts.app')

@section('title', 'Tableau de Bord Candidat')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-5 fw-bold">
                <i class="fas fa-user-tie text-primary"></i> Espace Candidat
            </h1>
            <p class="text-muted">Bienvenue dans votre espace personnel. Ici, vous pouvez gérer vos candidatures et explorer les opportunités.</p>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-briefcase fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Postes Candidés</h5>
                    <p class="display-6 fw-bold">12</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-envelope-open-text fa-2x text-warning mb-2"></i>
                    <h5 class="card-title">Réponses Reçues</h5>
                    <p class="display-6 fw-bold">5</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-calendar-check fa-2x text-info mb-2"></i>
                    <h5 class="card-title">Entretiens Planifiés</h5>
                    <p class="display-6 fw-bold">3</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières candidatures -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span><i class="fas fa-history me-2"></i> Dernières Candidatures</span>
            <a href="#" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nouvelle Candidature</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Poste</th>
                            <th>Entreprise</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Développeur Web</td>
                            <td>Tech Corp</td>
                            <td>10 Août 2025</td>
                            <td><span class="badge bg-warning text-dark">En attente</span></td>
                        </tr>
                        <tr>
                            <td>Analyste Data</td>
                            <td>DataPlus</td>
                            <td>5 Août 2025</td>
                            <td><span class="badge bg-success">Accepté</span></td>
                        </tr>
                        <tr>
                            <td>Chef de Projet</td>
                            <td>Innova</td>
                            <td>1 Août 2025</td>
                            <td><span class="badge bg-danger">Refusé</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
