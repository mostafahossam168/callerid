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
        Schema::table('mkhtbr_analyses', function (Blueprint $table) {
            $table->foreignId('package_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mkhtbr_analyses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('package_id');
        });
    }
};
