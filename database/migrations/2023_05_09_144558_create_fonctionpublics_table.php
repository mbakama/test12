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
        Schema::create('fonctionpublics', function (Blueprint $table) {
            $table->id();
            $table->string('NumMinTravail');
            $table->string('Num');
            $table->string('NomExpatrier');
            $table->string('LieuNais');
            $table->string('DateNais');
            $table->string('DateProgr');
            $table->integer('CodePays');
            $table->string('Fonction');
            $table->string('AdresseAffectation');
            $table->string('Obervation');
            $table->integer('NbreRenouvellement')->nullable();
            $table->integer('NbreNationaux');	
            $table->integer('NbreExpatrie');
            $table->string('Annee');
            $table->integer('CodeMois');
            $table->string('DateCreation');
            $table->string('CoNum');
            $table->integer('Status'); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonctionpublics');
    }
};
