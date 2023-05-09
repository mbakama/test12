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
        Schema::create('detailfps', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->string('CodeSource')->nullable();
            $table->float('MontantCreditFc');
            $table->float('MontantCreditUSD');
            $table->string('Promoteur')->nullable();
            $table->string('AdressPromoteur')->nullable();
            $table->string('observation')->nullable();
            $table->string('telephone')->nullable(); 
            $table->year('Annee');
            $table->integer('CoNum');
            $table->string('DateCreation');
            $table->integer('Status')->nullable();
            $table->softDeletes();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailfps');
    }
};
