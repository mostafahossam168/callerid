<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorIdToSupplyQuantities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supply_quantities', function (Blueprint $table) {
            $table->unsignedInteger('doctor_id')->nullable();
            $table->unsignedInteger('clinic_id')->nullable();
            $table->double('old_quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supply_quantities', function (Blueprint $table) {
            $table->dropColumn('doctor_id');
            $table->dropColumn('clinic_id');
            $table->dropColumn('old_quantity');
        });
    }
}
