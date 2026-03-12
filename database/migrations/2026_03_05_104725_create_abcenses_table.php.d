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
        Schema::create('abcenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participent_id')
            ->constrained('participents')->cascadeOnDelete();

            $table->foreignId('formation_id')
            ->constrained('formations')->cascadeOnDelete();

            $table->boolean('justify');

            $table->date('date_absence');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abcenses');
    }
};
