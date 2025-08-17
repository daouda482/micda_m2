@extends('layouts.app')

@section('title', 'Tableau de Bord - Plateforme de Recrutement')

@section('content')
<div class="container-fluid py-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="fw-bold text-primary">
                <i class="fas fa-briefcase"></i> Plateforme Numérique de Recrutement
            </h1>
            <p class="text-muted fs-5">De la publication des offres à la sélection finale des candidats</p>
        </div>
    </div>

    <!-- Statistiques globales -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 text-center p-3">
                <i class="fas fa-file-alt fa-2x text-primary mb-2"></i>
                <h5>Offres Publiées</h5>
                <p class="display-6 fw-bold">24</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 text-center p-3">
                <i class="fas fa-users fa-2x text-success mb-2"></i>
                <h5>Candidats Inscrits</h5>
                <p class="display-6 fw-bold">152</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 text-center p-3">
                <i class="fas fa-calendar-check fa-2x text-warning mb-2"></i>
                <h5>Entretiens Planifiés</h5>
                <p class="display-6 fw-bold">37</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 text-center p-3">
                <i class="fas fa-check-circle fa-2x text-info mb-2"></i>
                <h5>Sélections Finales</h5>
                <p class="display-6 fw-bold">18</p>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-chart-line me-2"></i> Évolution des candidatures
                </div>
                <div class="card-body">
                    <canvas id="applicationsChart" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-pie-chart me-2"></i> Statut des candidatures
                </div>
                <div class="card-body">
                    <canvas id="statusChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières activités -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <i class="fas fa-history me-2"></i> Dernières Activités
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>15 Août 2025</td>
                        <td>Publication d’une nouvelle offre</td>
                        <td>Jean Dupont</td>
                        <td><span class="badge bg-primary">Recruteur</span></td>
                    </tr>
                    <tr>
                        <td>14 Août 2025</td>
                        <td>Soumission d'une candidature</td>
                        <td>Marie Ndiaye</td>
                        <td><span class="badge bg-success">Candidat</span></td>
                    </tr>
                    <tr>
                        <td>13 Août 2025</td>
                        <td>Planification d’un entretien</td>
                        <td>Admin</td>
                        <td><span class="badge bg-dark">Administrateur</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scripts Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique des candidatures dans le temps
    new Chart(document.getElementById('applicationsChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août'],
            datasets: [{
                label: 'Candidatures',
                data: [12, 19, 15, 25, 30, 28, 35, 40],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                tension: 0.3,
                fill: true
            }]
        }
    });

    // Graphique des statuts
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: ['En attente', 'Accepté', 'Refusé'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#ffc107', '#198754', '#dc3545']
            }]
        }
    });
</script>
@endsection
