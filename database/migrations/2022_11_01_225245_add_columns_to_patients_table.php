<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->boolean('fluidity')->nullable();
            $table->boolean('aids')->nullable();
            $table->boolean('strokes')->nullable();
            $table->boolean('tuberculosis')->nullable();
            $table->boolean('epilepsy')->nullable();
            $table->boolean('psychiatric')->nullable();
            $table->boolean('cancer')->nullable();
            $table->boolean('eating_meat')->nullable();
            $table->boolean('fruits_and_vegetables')->nullable();
            $table->boolean('smoking')->nullable();
            $table->boolean('other_habits')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('fluidity');
            $table->dropColumn('aids');
            $table->dropColumn('strokes');
            $table->dropColumn('tuberculosis');
            $table->dropColumn('epilepsy');
            $table->dropColumn('psychiatric');
            $table->dropColumn('cancer');
            $table->dropColumn('eating_meat');
            $table->dropColumn('fruits_and_vegetables');
            $table->dropColumn('smoking');
            $table->dropColumn('other_habits');
        });
    }
}
