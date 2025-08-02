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
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('active_tamara')->nullable()->default(0);
            $table->boolean('active_tabby')->nullable()->default(0);
            $table->boolean('payment_gateways')->nullable()->default(0);
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
            $table->dropColumn('active_tamara');
            $table->dropColumn('active_tabby');
            $table->dropColumn('payment_gateways');
        });
    }
};
