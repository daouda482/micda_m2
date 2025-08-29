@extends('layouts.app')

@section('title', 'Dashboard Recruteur')

@section('content')
    <h2 class="mb-4"><i class="fas fa-home"></i> Tableau de Bord Admin</h2>

    <!-- Statistiques -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card p-3 shadow-sm bg-primary text-white">
                <h5><i class="fas fa-list"></i> Offres Publiées</h5>
                <h3>{{ $offresCount }}</h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3 shadow-sm bg-success text-white">
                <h5><i class="fas fa-users"></i> Candidatures</h5>
                <h3>{{ $candidaturesCount }}</h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3 shadow-sm bg-warning text-white">
                <h5><i class="fas fa-user-check"></i> Entretiens</h5>
                <h3>{{ $entretiensCount }}</h3>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card p-3 shadow-sm bg-info text-white">
                <h5><i class="fas fa-users"></i> Utilisateurs</h5>
                <h3>{{ $usersCount }}</h3>
            </div>
        </div>

    </div>

      <!-- Tableau des offres -->
    <div class="card p-3 shadow-sm">
        <h5><i class="fas fa-list"></i> Mes Offres Publiées</h5>
        <table class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Candidatures</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Développeur Laravel</td>
                    <td>15/08/2025</td>
                    <td>10</td>
                    <td><span class="badge bg-success">Ouvert</span></td>
                    <td>
                        <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Graphique -->
    <div class="card p-3 shadow-sm mb-4">
        <h5><i class="fas fa-chart-line"></i> Statistiques des Offres</h5>
        <canvas id="statsChart"></canvas>
    </div>

    <script>
        // Graphique Chart.js
        const ctx = document.getElementById('statsChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Candidatures',
                    data: [12, 19, 3, 5, 8, 15],
                    backgroundColor: '#0d6efd'
                }]
            }
        });
    </script>
@endsection
