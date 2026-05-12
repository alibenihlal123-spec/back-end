<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('participents', function (Blueprint $table) {
            $table->foreignId('formation_id')->nullable()->constrained('formations')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('participents', function (Blueprint $table) {
            $table->dropForeign(['formation_id']);
            $table->dropColumn('formation_id');
        });
    }
};

