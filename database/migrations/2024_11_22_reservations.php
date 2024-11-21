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
        Schema::create('Reservation', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // User ID
            $table->unsignedBigInteger('device_id'); // Device ID
            $table->datetime('reservation_date'); // Date and time of reservation
            $table->integer('duration'); // Duration in days
            $table->string('status', 50); // Reservation status
            $table->timestamps(); // created_at and updated_at
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('Device')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Reservation', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['device_id']);
        });
        Schema::dropIfExists('Reservation');
    }
};
