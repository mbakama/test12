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
        Schema::create('detail_licences', function (Blueprint $table) {
            $table->id();
            $table->string('CodeDetailLicence');
            $table->string('serie');
            $table->string('codeDouane');
            $table->string('codePaysOrg');
            $table->integer('quantite');
            $table->integer('codeDevice');
            $table->float('prixUnit');
            $table->char('unitStat');
            $table->datetime('DateSaisie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_licences');
    }
};
