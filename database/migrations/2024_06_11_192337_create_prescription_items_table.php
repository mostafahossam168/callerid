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
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_medicine_id')->constrained('pharmacy_medicines')->cascadeOnDelete();
            $table->foreignId('pharmacy_prescription_id')->constrained('pharmacy_prescriptions')->cascadeOnDelete();
            $table->integer('quantity');
            $table->double('total')->nullable();
            $table->string('duration')->nullable();
            $table->string('repetition')->nullable();
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
        Schema::dropIfExists('prescription_items');
    }
};
