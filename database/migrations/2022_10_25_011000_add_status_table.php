<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacy_requests', function (Blueprint $table) {
            $table->enum('status', ['paid', 'pending'])->default('pending');
            $table->text('paid_drugs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacy_requests', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('paid_drugs');
        });
    }
}
