<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('patient_id')->nullable();
            $table->unsignedInteger('animal_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->enum('status', ['paid', 'unpaid', 'partially_paid','retrieved'])->default('unpaid');
            $table->date('date');
            $table->double('amount');
            $table->double('discount')->nullable()->default(0);
            $table->double('tax')->nullable()->default(0);
            $table->double('total');
            $table->double('cash')->nullable()->default(0);
            $table->double('card')->nullable()->default(0);
            $table->double('rest')->nullable()->default(0);
            $table->double('refund')->nullable();
            $table->enum('refund_status', ['creditor', 'debtor'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
