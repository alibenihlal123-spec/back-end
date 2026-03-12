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
        Schema::create('pivots', function (Blueprint $table) {
            $table->id();

            // $table->bigInteger('formation_id');
            // $table->foreign('formation_id')->references('id')->on('formations')->cascadeOnDelete();
            // $table->bigInteger('animater_id')->foreign('animater_id')->references('id')->on('animaters')->cascadeOnDelete();
            // $table->bigInteger('theme_id')->foreign('theme_id')->references('id')->on('themes')->cascadeOnDelete();
            $table->foreignId('formation_id')->constrained('formations')->cascadeOnDelete();
            $table->foreignId('animater_id')->constrained('animaters')->cascadeOnDelete();
            $table->foreignId('theme_id')->constrained('themes')->cascadeOnDelete();
            // $table->foreignId('participent_id')
            // ->constrained('participents')->cascadeOnDelete();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivots');
    }
};
