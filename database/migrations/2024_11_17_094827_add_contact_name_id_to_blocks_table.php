<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->foreignId('contact_name_id')->nullable()->constrained()->cascadeOnDelete();
            $table->dropConstrainedForeignId('contact_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('contact_name_id');
            $table->foreignId('contact_id')->constrained('contacts')->cascadeOnDelete();

        });
    }
};
