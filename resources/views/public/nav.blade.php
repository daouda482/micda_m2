<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container">
			<a class="navbar-brand" href="/">Job Portail</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('public.index') }}">Accueil</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('public.offres') }}">Trouver un emploi</a>
					</li>
				</ul>

				@guest
					<a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Se connecter</a>
					<a class="btn btn-primary me-2" href="{{ route('register') }}">S'inscrire</a>
				@endguest

				@auth
					<div class="d-flex align-items-center">
						<span class="me-3 fw-bold"><i class="fa fa-user"></i> {{ Auth::user()->prenom }} {{ Auth::user()->name }}</span>

                        <!-- Condition selon le rôle -->
                        @if(Auth::user()->role === 'candidat')
                            <a class="btn btn-outline-primary me-2" href="{{ route('public.mesOffres') }}">Mes offres</a>
                        @elseif(Auth::user()->role === 'recruteur')
                            <a class="btn btn-outline-primary me-2" href="{{ route('recruteur.dashboard') }}">Dashboard Recruteur</a>
                        @elseif(Auth::user()->role === 'admin')
                            <a class="btn btn-outline-primary me-2" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                        @endif

						<!-- Formulaire de déconnexion -->
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
							@csrf
							<button type="button" class="btn btn-danger" onclick="confirmLogout()">Se déconnecter</button>
						</form>
					</div>
				@endauth

			</div>
		</div>
	</nav>
</header>

<script>
	function confirmLogout() {
		if (confirm("Voulez-vous vraiment vous déconnecter ?")) {
			document.getElementById('logout-form').submit();
		}
	}
</script>
