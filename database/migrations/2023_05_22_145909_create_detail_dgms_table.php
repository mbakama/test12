<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_dgms', function (Blueprint $table) {
            $table->id();
            $table->integer('NumDGM');
            $table->integer('Num');
            $table->string('Nom')->nullable();
            $table->string('Postnon')->nullable();
            $table->integer('Sexe')->nullable();
            $table->char('EtatCivil', 5)->nullable();
            $table->integer('CodePays')->nullable();
            $table->dateTime('DateNais')->nullable();
            $table->string('Profession')->nullable();
            $table->string('CodTypeVisa')->nullable();
            $table->mediumText('LibellePaysAjout')->nullable();
            $table->dateTime('DatExpirationVisa')->nullable();
            $table->integer('CoNum')->unsigned()->nullable();
            $table->dateTime('DateSaisie')->nullable(); 
            $table->boolean("Statut");
            $table->year('Annee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_dgms');
    }
};