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
        Schema::create('pharmacy_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name')->nullable();
            $table->foreignId('pharmacy_warehouse_id')->constrained()->cascadeOnDelete();
            $table->integer('opening_balance')->default(0);
            $table->foreignId('pharmacy_type_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('pharmacy_dangerous_id')->nullable()->constrained('pharmacy_dangerouses')->nullOnDelete();
            $table->string('barcode')->nullable();
            $table->double('purchasing_price');
            $table->double('selling_price');
            $table->date('expiry_date');
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
        Schema::dropIfExists('pharmacy_medicines');
    }
};
