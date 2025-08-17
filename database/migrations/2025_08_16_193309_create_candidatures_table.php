<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->constrained('offres')->onDelete('cascade');
            $table->foreignId('candidat_id')->constrained('users')->onDelete('cascade');
            $table->enum('statut', ['en attente', 'en cours', 'accepte', 'refuse'])->default('en attente');
            $table->text('message')->nullable();
            $table->text('experience')->nullable();
            $table->text('competence')->nullable();
            $table->string('cv')->nullable();
            $table->string('lettre_motivation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
