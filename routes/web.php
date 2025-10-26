<?php

use App\Http\Controllers\Admin\AdminCandidatureController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminEntretienController;
use App\Http\Controllers\Admin\AdminOfferController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\EntrepriseController;
use App\Http\Controllers\Candidat\CandidatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Recruteur\CandidatureController;
use App\Http\Controllers\Recruteur\RecruteurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruteur\EntretienController;
use App\Http\Controllers\Recruteur\OffreController;
use App\Http\Controllers\Recruteur\RecruteurEntrepriseController;

// ================ PUBLIC ==========================
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/offres', [PublicController::class, 'listeOffres'])->name('public.offres');
Route::get('/details-offres/{offre}', [PublicController::class, 'offreDetails'])->name('public.offreDetails');

Route::get('/offres/{offre}/postuler', [CandidatController::class, 'create'])->name('candidatures.create');
Route::post('/offres/{offre}/postuler', [CandidatController::class, 'store'])->name('candidatures.store');

Route::get('/mes-offres', [CandidatController::class, 'mesOffres'])->name('public.mesOffres');

Route::get('/entreprises/{entreprise}', [PublicController::class, 'show'])->name('entreprises.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ============== RECRUTEUR ==========================
Route::prefix('recruteur')->middleware(['auth', 'role:recruteur'])->name('recruteur.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [RecruteurController::class, 'index'])->name('dashboard');
    // Entreprises
    Route::resource('entreprises', RecruteurEntrepriseController::class);

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
    Route::get('/candidat/dashboard', [CandidatController::class, 'mesOffres'])->name('public.mesOffres');
});


//======================= ADMIN ========================================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Entreprises
    Route::resource('entreprises', EntrepriseController::class);

    // Offres
    Route::resource('offres', AdminOfferController::class);

    Route::get('/utilisateurs', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/utilisateurs/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/utilisateurs', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/utilisateurs/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/utilisateurs/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/utilisateurs/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Candidatures
    Route::get('/candidatures', [AdminCandidatureController::class, 'index'])->name('candidatures.index');
    Route::post('/candidatures/{id}/accept', [AdminCandidatureController::class, 'accept'])->name('candidatures.accept');
    Route::post('/candidatures/{id}/reject', [AdminCandidatureController::class, 'reject'])->name('candidatures.reject');
    Route::get('/candidatures/{id}', [AdminCandidatureController::class, 'show'])->name('candidatures.show');
    Route::post('/candidatures/{id}/entretien', [AdminCandidatureController::class, 'planifierEntretien'])->name('candidatures.entretien');

    // Entretiens
    Route::get('/entretiens', [AdminEntretienController::class, 'index'])->name('entretiens.index');
    Route::get('/entretiens/planifier/{candidature}', [AdminEntretienController::class, 'create'])->name('entretiens.planifier');

    Route::post('/entretiens/planifier/{candidature}', [AdminEntretienController::class, 'store'])->name('entretiens.store');

});



//=======================Gestion des offres========================================



