<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->enum('type', ['purchases', 'stocks']);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('category_child_id');
            $table->integer('qty')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('date')->nullable();
            $table->foreignId('supply_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('category_id');
            $table->dropColumn('category_child_id');
            $table->dropColumn('tax_number');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('date');
            $table->dropColumn('qty');
        });
    }
};
