<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->string('sugar_rate')->nullable();
            $table->string('pressure_rate')->nullable();
            $table->string('temperature')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('breathing_rate')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('sugar_measurement')->nullable();
            $table->string('head_and_neck')->nullable();
            $table->string('belly')->nullable();
            $table->string('chest_and_back')->nullable();
            $table->string('upper_lower_extremities')->nullable();
            $table->string('pelvis')->nullable();
            $table->text('vaccinations')->nullable();
            $table->text('sensitivity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            //
        });
    }
}
