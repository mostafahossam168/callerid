<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->boolean('family_fluidity')->nullable();
            $table->boolean('family_pressure')->nullable();
            $table->boolean('family_heart')->nullable();
            $table->boolean('family_sugar')->nullable();
            $table->boolean('family_liver')->nullable();
            $table->boolean('family_aids')->nullable();
            $table->boolean('family_strokes')->nullable();
            $table->boolean('family_epilepsy')->nullable();
            $table->boolean('family_kidneys')->nullable();
            $table->boolean('family_psychiatric')->nullable();
            $table->boolean('family_anemia')->nullable();
            $table->boolean('family_cancer')->nullable();
            $table->boolean('family_smoking')->nullable();
            $table->boolean('allergies')->nullable();
            $table->boolean('family_allergies')->nullable();
            $table->boolean('pharmaceutical')->nullable();
            $table->boolean('family_pharmaceutical')->nullable();
            $table->boolean('past_surgical')->nullable();
            $table->boolean('family_past_surgical')->nullable();
            $table->boolean('safety_of_senses')->nullable();
            $table->boolean('family_safety_of_senses')->nullable();
            $table->string('last_visit_question')->nullable();
            $table->text('last_visit_answer')->nullable();
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
            $table->dropColumn('family_fluidity');
            $table->dropColumn('family_pressure');
            $table->dropColumn('family_heart');
            $table->dropColumn('family_sugar');
            $table->dropColumn('family_liver');
            $table->dropColumn('family_aids');
            $table->dropColumn('family_strokes');
            $table->dropColumn('family_epilepsy');
            $table->dropColumn('family_kidneys');
            $table->dropColumn('family_psychiatric');
            $table->dropColumn('family_anemia');
            $table->dropColumn('family_cancer');
            $table->dropColumn('family_smoking');
            $table->dropColumn('allergies');
            $table->dropColumn('family_allergies');
            $table->dropColumn('pharmaceutical');
            $table->dropColumn('family_pharmaceutical');
            $table->dropColumn('past_surgical');
            $table->dropColumn('family_past_surgical');
            $table->dropColumn('safety_of_senses');
            $table->dropColumn('family_safety_of_senses');
            $table->dropColumn('last_visit_question');
            $table->dropColumn('last_visit_answer');
        });
    }
}
