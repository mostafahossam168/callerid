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
        Schema::create('pharmacy_quantities', function (Blueprint $table) {
            $table->id();
            $table->morphs('item');
            $table->integer('quantity');
            $table->foreignId('pharmacy_warehouse_id')->nullable()->constrained('pharmacy_warehouses')->cascadeOnDelete();
            $table->foreignId('from_warehouse_id')->nullable()->constrained('pharmacy_warehouses')->cascadeOnDelete();
            $table->foreignId('to_warehouse_id')->nullable()->constrained('pharmacy_warehouses')->cascadeOnDelete();
            $table->enum('type', ['charge', 'expense', 'transfer'])->nullable();
            $table->foreignId('employee_id')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('last_update')->nullable()->constrained('users', 'id')->nullOnDelete();
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
        Schema::dropIfExists('pharmacy_quantities');
    }
};
