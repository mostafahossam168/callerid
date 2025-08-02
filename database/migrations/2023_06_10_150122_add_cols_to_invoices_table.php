<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->double('visa')->nullable()->default(0);
            $table->double('mastercard')->nullable()->default(0);
            $table->boolean('installment_company')->default(false)->nullable();
            $table->double('installment_company_tax')->nullable();
            $table->double('installment_company_max_amount_tax')->nullable();
            $table->double('installment_company_min_amount_tax')->nullable();
            $table->double('installment_company_rest')->nullable();
            $table->boolean('tab')->default(false)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('installment_company');
            $table->dropColumn('installment_company_tax');
            $table->dropColumn('installment_company_max_amount_tax');
            $table->dropColumn('installment_company_min_amount_tax');
            $table->dropColumn('installment_company_rest');
            $table->dropColumn('tab');
            $table->dropColumn('visa');
            $table->dropColumn('mastercard');

        });
    }
}
