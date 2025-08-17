@extends('layouts.app')

@section('title', 'Tableau de bord - Administrateur')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky pt-3">
                <h5 class="text-white text-center">Admin Panel</h5>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('admin.users.index')}}">
                            <i class="fas fa-users me-2"></i> Utilisateurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="">
                            <i class="fas fa-user-tie me-2"></i> Recruteurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-user-graduate me-2"></i> Candidats
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-briefcase me-2"></i> Offres d'emploi
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <h2 class="mb-4">Bienvenue, Administrateur</h2>

            <!-- Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card text-bg-primary h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users"></i> Utilisateurs</h5>
                            <p class="card-text fs-4">{{ $stats['users'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-success h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user-tie"></i> Recruteurs</h5>
                            <p class="card-text fs-4">{{ $stats['recruiters'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-warning h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user-graduate"></i> Candidats</h5>
                            <p class="card-text fs-4">{{ $stats['candidates'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-danger h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-briefcase"></i> Offres</h5>
                            <p class="card-text fs-4">{{ $stats['offers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-chart-line"></i> Statistiques des candidatures</h5>
                </div>
                <div class="card-body">
                    <canvas id="applicationsChart" height="100"></canvas>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('applicationsChart');
    const chartData = {!! json_encode($chartData ?? [5,8,6,10,12,9,14]) !!};

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map((_, i) => 'Jour ' + (i + 1)),
            datasets: [{
                label: 'Candidatures',
                data: chartData,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.1)',
                tension: 0.3
            }]
        }
    });
</script>
@endpush
