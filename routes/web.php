<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Candidat\CandidatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Recruteur\RecruteurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruteur\CandidatureController;
use App\Http\Controllers\Recruteur\EntretienController;
use App\Http\Controllers\Recruteur\OffreController;

// ================ PUBLIC ==========================
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/offres', [PublicController::class, 'listeOffres'])->name('public.offres');
Route::get('/details-offres/{offre}', [PublicController::class, 'offreDetails'])->name('public.offreDetails');
Route::get('/postuler-offre', [PublicController::class, 'postulerOffre'])->name('public.postulerOffre');
Route::get('/mes-offres', [PublicController::class, 'mesOffres'])->name('public.mesOffres');

Route::get('/entreprises/{entreprise}', [PublicController::class, 'show'])->name('entreprises.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ============== ADMIN ==============================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// ============== RECRUTEUR ==========================
Route::prefix('recruteur')->middleware(['auth', 'role:recruteur'])->name('recruteur.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [RecruteurController::class, 'index'])->name('dashboard');
    // Entreprises
    Route::get('/entreprises', [RecruteurController::class, 'listeEntreprises'])->name('entreprises.index');

    // Offres
    Route::resource('offres', OffreController::class);

    // Candidatures
    Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
    Route::post('/candidatures/{id}/accept', [CandidatureController::class, 'accept'])->name('candidatures.accept');
    Route::post('/candidatures/{id}/reject', [CandidatureController::class, 'reject'])->name('candidatures.reject');
    Route::get('/candidatures/{id}', [CandidatureController::class, 'show'])->name('candidatures.show');
    Route::post('/candidatures/{id}/entretien', [CandidatureController::class, 'planifierEntretien'])->name('candidatures.entretien');

    // Entretiens
    Route::get('/entretiens', [EntretienController::class, 'index'])->name('entretiens.index');
    Route::get('/entretiens/planifier/{candidature}', [EntretienController::class, 'create'])->name('entretiens.planifier');

    Route::post('/entretiens/planifier/{candidature}', [EntretienController::class, 'store'])->name('entretiens.store');
});

// ============== CANDIDAT ===========================
Route::middleware(['auth', 'role:candidat'])->group(function () {
    Route::get('/candidat/dashboard', [CandidatController::class, 'index'])->name('candidat.dashboard');
});


//=======================Role de l'administrateur========================================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function() {

    Route::get('users', [App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}/edit', [App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('admin.users.destroy');



});



//=======================Gestion des offres========================================



