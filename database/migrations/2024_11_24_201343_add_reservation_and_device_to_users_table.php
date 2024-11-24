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
        Schema::table('users', function (Blueprint $table) {
            // Add column to indicate if the user can make reservations
            $table->boolean('can_make_reservations')->default(true);

            // Add device_id as a foreign key
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['device_id']); // Drop foreign key constraint
            $table->dropColumn('device_id'); // Remove device_id column
            $table->dropColumn('can_make_reservations'); // Remove can_make_reservations column
        });
    }
};
