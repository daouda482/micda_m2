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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidat_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('candidature_id')->constrained('candidatures')->onDelete('cascade');
            $table->dateTime('date_entretien');
            $table->string('lieu')->nullable();
            $table->string('message')->nullable(); // Zoom/Meet/Teams
            $table->enum('statut', ['planifié', 'annulé'])->default('planifié');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
