<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('studios', function (Blueprint $table) {
            // Přidání sloupce 'photo' pro uložení cesty k obrázku
            $table->string('photo')->nullable(); // sloupec bude typu string a povolený NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studios', function (Blueprint $table) {
            // Vrátí změnu a odstraní sloupec 'photo'
            $table->dropColumn('photo');
        });
    }
};
