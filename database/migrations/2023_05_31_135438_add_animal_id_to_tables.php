<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnimalIdToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->foreignId('animal_id')->nullable()->constrained('animals')->cascadeOnDelete();
        });
        Schema::table('patient_files', function (Blueprint $table) {
            $table->foreignId('animal_id')->nullable()->constrained('animals')->cascadeOnDelete();
        });
        Schema::table('scan_requests', function (Blueprint $table) {
            $table->foreignId('animal_id')->nullable()->constrained('animals')->cascadeOnDelete();
        });
        Schema::table('lab_requests', function (Blueprint $table) {
            $table->foreignId('animal_id')->nullable()->constrained('animals')->cascadeOnDelete();
        });
        Schema::table('point_logs', function (Blueprint $table) {
            $table->foreignId('animal_id')->nullable()->constrained('animals')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}