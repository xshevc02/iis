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
        Schema::table('loans', function (Blueprint $table) {
            $table->time('available_from')->nullable()->after('room'); // Add available_from column
            $table->time('available_to')->nullable()->after('available_from'); // Add available_to column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('available_from'); // Remove available_from column
            $table->dropColumn('available_to'); // Remove available_to column
        });
    }
};
