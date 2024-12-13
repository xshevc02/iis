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
        Schema::table('Devices', function (Blueprint $table) {
            $table->string('photo', 255)->nullable()->after('user_id'); // Přidání sloupce
        });
    }

    public function down(): void
    {
        Schema::table('Devices', function (Blueprint $table) {
            $table->dropColumn('photo'); // Odstranění sloupce
        });
    }

};
