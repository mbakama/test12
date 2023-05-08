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
        Schema::create('detailfpis', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->string('CodeSource');
            $table->float('MontantCreditFc');
            $table->float('MontantCreditUSD');
            $table->string('Promoteur');
            $table->string('AdressPromoteur');
            $table->string('observation');
            $table->year('Annee');
            $table->integer('CoNum');
            $table->string('DateCreation');
            $table->integer('Status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailfpis');
    }
};