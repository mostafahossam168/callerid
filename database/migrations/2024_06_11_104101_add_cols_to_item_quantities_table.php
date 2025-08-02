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
        Schema::table('item_quantities', function (Blueprint $table) {
            $table->foreignId('warehouse_id')->after('item_id')->nullable()->constrained('warehouses', 'id')->cascadeOnDelete();
            $table->foreignId('from_warehouse_id')->after('warehouse_id')->nullable()->constrained('warehouses', 'id')->cascadeOnDelete();
            $table->foreignId('to_warehouse_id')->after('from_warehouse_id')->nullable()->constrained('warehouses', 'id')->cascadeOnDelete();
            $table->enum('type', ['charge', 'expense', 'transfer'])->after('quantity')->nullable();
            $table->date('expire_date')->after('type')->nullable();
            $table->foreignId('employee_id')->after('expire_date')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('last_update')->after('employee_id')->nullable()->constrained('users', 'id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_quantities', function (Blueprint $table) {
            $table->dropConstrainedForeignId('warehouse_id');
            $table->dropConstrainedForeignId('employee_id');
            $table->dropConstrainedForeignId('last_update');
            $table->dropColumn(['type', 'expire_date']);
        });
    }
};
