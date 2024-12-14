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
        Schema::create('toilets', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->enum('price', ['Free', 'Paid']);
            $table->string('payment_methods')->nullable();
            $table->enum('type', ['Public', 'Restaurant', 'Store', 'Gas Station', 'Bar', 'Other']);
            $table->boolean('is_free');
            $table->boolean('is_accessible');
            $table->json('opening_hours');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toilets');
    }
};
