<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formation_participent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')->constrained('formations')->cascadeOnDelete();
            $table->foreignId('participent_id')->constrained('participents')->cascadeOnDelete();
            // Unique constraint to prevent duplicate assignments
            $table->unique(['formation_id', 'participent_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formation_participent');
    }
};
