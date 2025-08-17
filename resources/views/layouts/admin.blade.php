{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin | e-Recrutement')</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root{
            --sidebar-w: 280px;
        }
        body{ background:#f6f8fb; }
        .sidebar{
            width:var(--sidebar-w);
            min-height:100vh;
            position:fixed;
            top:0; left:0;
            background:#0f172a; /* slate-900 */
            color:#cbd5e1;
            z-index:1031;
        }
        .sidebar .brand{
            font-weight:700; letter-spacing:.5px;
        }
        .sidebar a{
            color:#cbd5e1; text-decoration:none;
        }
        .sidebar .nav-link{
            border-radius:.75rem; padding:.65rem .9rem;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover{
            background:#1e293b; color:#fff;
        }
        .content-wrapper{
            margin-left:var(--sidebar-w);
            min-height:100vh;
        }
        .topbar{
            position:sticky; top:0; z-index:1030;
            backdrop-filter:saturate(180%) blur(6px);
            background:rgba(255,255,255,.8);
            border-bottom:1px solid #e9ecef;
        }
        .kpi-card{
            border:0; border-radius:1rem; background:#fff;
            box-shadow:0 6px 20px rgba(15,23,42,.08);
        }
        .table thead th{ background:#f1f5f9; }
        @media (max-width: 992px){
            .sidebar{ transform:translateX(-100%); transition:transform .25s ease; }
            .sidebar.show{ transform:translateX(0); }
            .content-wrapper{ margin-left:0; }
        }
    </style>
    @stack('head')
</head>
<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar d-flex flex-column p-3">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a class="brand d-flex align-items-center gap-2 text-white" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-briefcase"></i> <span>e-Recrutement</span>
            </a>
            <button class="btn btn-sm btn-outline-light d-lg-none" id="btnSidebarClose">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <small class="text-uppercase text-secondary mb-2">Navigation</small>
        <nav class="nav flex-column gap-1">
            <a class="nav-link @yield('nav.dashboard')" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge-high me-2"></i> Tableau de bord
            </a>
            <a class="nav-link @yield('nav.offres')" href="#">
                <i class="fa-solid fa-clipboard-list me-2"></i> Offres d’emploi
            </a>
            <a class="nav-link @yield('nav.candidatures')" href="#">
                <i class="fa-solid fa-file-circle-check me-2"></i> Candidatures
            </a>
            <a class="nav-link @yield('nav.entreprises')" href="#">
                <i class="fa-solid fa-building me-2"></i> Entreprises
            </a>

            <small class="text-uppercase text-secondary mt-3 mb-2">Utilisateurs</small>
            <a class="nav-link @yield('nav.utilisateurs')" href="#">
                <i class="fa-solid fa-users me-2"></i> Tous les utilisateurs
            </a>
            <a class="nav-link @yield('nav.recruteurs')" href="#">
                <i class="fa-solid fa-user-tie me-2"></i> Recruteurs
            </a>
            <a class="nav-link @yield('nav.candidats')" href="#">
                <i class="fa-solid fa-user me-2"></i> Candidats
            </a>

            <small class="text-uppercase text-secondary mt-3 mb-2">Configuration</small>
            <a class="nav-link @yield('nav.categories')" href="#">
                <i class="fa-solid fa-tags me-2"></i> Catégories & Tags
            </a>
            <a class="nav-link @yield('nav.parametres')" href="#">
                <i class="fa-solid fa-gear me-2"></i> Paramètres
            </a>
        </nav>

        <div class="mt-auto pt-3 border-top border-secondary">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-light text-dark d-flex align-items-center justify-content-center" style="width:36px; height:36px;">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="small">
                    <div class="fw-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-secondary">Administrateur</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-outline-light w-100">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Déconnexion
                </button>
            </form>
        </div>
    </aside>

    {{-- CONTENT --}}
    <div class="content-wrapper">
        {{-- TOPBAR --}}
        <header class="topbar">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-outline-secondary d-lg-none" id="btnSidebarOpen">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <h6 class="mb-0">@yield('page-title', 'Tableau de bord')</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalCreateOffer">
                            <i class="fa-solid fa-plus me-1"></i> Nouvelle offre
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateUser">
                            <i class="fa-solid fa-user-plus me-1"></i> Nouvel utilisateur
                        </button>
                    </div>
                </div>
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="container-fluid py-4">
            @yield('content')
        </main>

        <footer class="py-3 border-top bg-white">
            <div class="container-fluid small text-secondary d-flex justify-content-between">
                <span>© {{ date('Y') }} e-Recrutement — Admin</span>
                <span>Version 1.0</span>
            </div>
        </footer>
    </div>

    {{-- MODALES COMMUNES --}}
    {{-- Créer une offre --}}
    <div class="modal fade" id="modalCreateOffer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form class="modal-content" method="POST" action="{{ route('admin.offers.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-clipboard-list me-2"></i>Créer une offre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Titre du poste</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option>CDI</option><option>CDD</option><option>Stage</option><option>Freelance</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Entreprise</label>
                        <input name="company" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Localisation</label>
                        <input name="location" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Catégorie</label>
                        <select name="category_id" class="form-select">
                            {{-- @foreach($categories as $cat) <option value="{{ $cat->id }}">{{ $cat->name }}</option> @endforeach --}}
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date de clôture</label>
                        <input type="date" name="deadline" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" type="submit">Publier</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Créer un utilisateur --}}
    <div class="modal fade" id="modalCreateUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-user-plus me-2"></i>Créer un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-12">
                        <label class="form-label">Nom</label>
                        <input name="name" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rôle</label>
                        <select name="role" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="recruteur">Recruteur</option>
                            <option value="candidat">Candidat</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mot de passe</label>
                        <input name="password" type="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" type="submit">Créer</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Chart.js for analytics --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script>
        // Sidebar mobile toggle
        const sidebar = document.querySelector('.sidebar');
        const btnOpen = document.getElementById('btnSidebarOpen');
        const btnClose = document.getElementById('btnSidebarClose');
        btnOpen?.addEventListener('click', ()=> sidebar.classList.add('show'));
        btnClose?.addEventListener('click', ()=> sidebar.classList.remove('show'));
    </script>

    @stack('scripts')
</body>
</html>
