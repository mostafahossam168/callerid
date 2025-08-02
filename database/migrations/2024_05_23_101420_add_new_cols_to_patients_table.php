<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('tax_number')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('building_number')->nullable();
            $table->string('postal_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('tax_number');
            $table->dropColumn('address');
            $table->dropColumn('street');
            $table->dropColumn('building_number');
            $table->dropColumn('postal_code');
        });
    }
};
