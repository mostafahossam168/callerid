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
        Schema::table('analysis_departments', function (Blueprint $table) {
            $table->double('min_range')->nullable()->default(0);
            $table->double('max_range')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('analysis_departments', function (Blueprint $table) {
            $table->dropColumn(['min_range', 'max_range']);
        });
    }
};
