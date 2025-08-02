<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mkhtbr_analyses', function (Blueprint $table) {
            $table->string('lab_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mkhtbr_analyses', function (Blueprint $table) {
            $table->dropColumn('lab_id');
        });
    }
};
