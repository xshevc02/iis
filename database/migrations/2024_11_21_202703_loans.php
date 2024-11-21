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
        Schema::create('Loans', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to Users table
            $table->unsignedBigInteger('device_id'); // Foreign key to Devices table
            $table->datetime('issue_date'); // Date and time the loan was issued
            $table->datetime('return_date')->nullable(); // Date and time the loan was returned
            $table->time('time_from'); // Loan start time
            $table->time('time_to'); // Loan end time
            $table->string('status', 50); // Loan status (e.g., "Loaned", "Returned")
            $table->timestamps(); // created_at and updated_at
            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('Device')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Loans', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['device_id']);
        });
        Schema::dropIfExists('Loans');
    }
};
