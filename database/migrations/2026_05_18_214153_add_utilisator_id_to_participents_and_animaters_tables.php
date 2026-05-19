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
        Schema::table('participents', function (Blueprint $table) {
            $table->foreignId('utilisator_id')->nullable()->constrained('utilisators')->cascadeOnDelete();
        });

        Schema::table('animaters', function (Blueprint $table) {
            $table->foreignId('utilisator_id')->nullable()->constrained('utilisators')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participents', function (Blueprint $table) {
            $table->dropForeign(['utilisator_id']);
            $table->dropColumn('utilisator_id');
        });

        Schema::table('animaters', function (Blueprint $table) {
            $table->dropForeign(['utilisator_id']);
            $table->dropColumn('utilisator_id');
        });
    }
};
