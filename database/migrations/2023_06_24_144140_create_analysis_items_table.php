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
        Schema::create('analysis_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mkhtbr_analysis_id')->nullable()->constrained('mkhtbr_analyses', 'id')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('analysis_departments', 'id')->cascadeOnDelete();
            $table->double('result')->nullable()->default(0);
            $table->string('range')->nullable();
            $table->string('unit')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analysis_items');
    }
};
