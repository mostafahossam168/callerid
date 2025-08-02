<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->text('treatment')->nullable()->change();
            $table->text('taken')->nullable()->change();
            $table->string('temperature_rate')->nullable();
            $table->string('heart_rate')->nullable();
            $table->text('current_symptoms')->nullable();
            $table->text('cupping_type')->nullable();
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
            $table->dropColumn('temperature_rate');
            $table->dropColumn('heart_rate');
            $table->dropColumn('current_symptoms');
            $table->dropColumn('cupping_type');
        });
    }
}
