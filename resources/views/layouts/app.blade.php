<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "Tableau de Bord") | {{ Auth::user()->role ?? 'Utilisateur' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .header {
            background: #0d6efd;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header h4 {
            margin: 0;
            font-weight: bold;
        }

        

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header .user-info i {
            font-size: 20px;
        }

        .sidebar {
            height: 100vh;
            background-color: #0d6efd;
            color: white;
            padding-top: 20px;
            position: fixed;
            top: 65px;
            /* décalage à cause du header */
            left: 0;
            width: 220px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
        }

        .sidebar a:hover {
            background-color: #0b5ed7;
            border-radius: 5px;
        }

        .sidebar a.active {
            background-color: #0b5ed7;
            color: #fff !important;
            font-weight: bold;
            border-radius: 5px;
        }

        .content {
            margin-left: 220px;
            /* espace pour sidebar */
            margin-top: 80px;
            /* espace pour header */
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h4><i class="fas fa-briefcase"></i>
            <a href="{{ route('public.index') }}" class="text-light">Job Portail</a> | Tableau de Bord
        </h4>
        <div class="user-info">
            <span><i class="fas fa-user-circle"></i> {{ Auth::user()->role ?? 'Utilisateur' }}</span>
            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        @if(Auth::user() && Auth::user()->role === 'recruteur')
            <a href="{{ route('recruteur.dashboard') }}"
                class="{{ request()->routeIs('recruteur.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Tableau de Bord
            </a>
            <a href="{{ route('recruteur.entreprises.index') }}"
                class="{{ request()->routeIs('recruteur.entreprises.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Mes Entreprises
            </a>
            <a href="{{ route('recruteur.offres.create') }}"
                class="{{ request()->routeIs('recruteur.offres.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i> Publier une Offre
            </a>
            <a href="{{ route('recruteur.offres.index') }}"
                class="{{ request()->routeIs('recruteur.offres.index') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Mes Offres
            </a>
            <a href="{{ route('recruteur.candidatures.index') }}"
                class="{{ request()->routeIs('recruteur.candidatures.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Candidatures
            </a>
            <a href="{{ route('recruteur.entretiens.index') }}"
                class="{{ request()->routeIs('recruteur.entretiens.*') ? 'active' : '' }}">
                <i class="fas fa-calendar"></i> Entretiens
            </a>
            <a href="#">
                <i class="fas fa-user-circle"></i> Profil
            </a>
        @elseif(Auth::user() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Tableau de Bord
            </a>
            <a href="{{ route('admin.users.index') }}"
                class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                <i class="fas fa-users-cog"></i> Utilisateurs
            </a>
            <a href="{{ route('admin.entreprises.index') }}"
                class="{{ request()->routeIs('admin.entreprises.index') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Entreprises
            </a>
            <a href="{{ route('admin.offres.index') }}"
                class="{{ request()->routeIs('admin.offres.index') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Offres d'emploi
            </a>
            <a href=""
                class="">
                <i class="fas fa-file-alt"></i> Candidatures
            </a>
            <a href=""
                class="">
                <i class="fas fa-cogs"></i> Paramètres
            </a>
            <a href="#">
                <i class="fas fa-user-circle"></i> Profil
            </a>
        @endif
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <script>
        // Exemple graphique
        const ctx = document.getElementById('statsChart');
        if (ctx) {
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
        }
    </script>

</body>

</html>
