<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('befor_appointment_message_status')->nullable();
            $table->string('befor_appointment_message')->nullable();
            $table->boolean('create_appointment_message_status')->nullable();
            $table->string('create_appointment_message')->nullable();
            $table->boolean('cancel_appointment_message_status')->nullable();
            $table->string('cancel_appointment_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
