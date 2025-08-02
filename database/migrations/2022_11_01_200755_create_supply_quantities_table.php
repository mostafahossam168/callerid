<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplyQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_quantities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supply_id')->nullable()->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->double('price')->nullable();
            $table->enum('type', ['in', 'out'])->nullable();
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
        Schema::dropIfExists('supply_quantities');
    }
}
