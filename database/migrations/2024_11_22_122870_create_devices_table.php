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
        Schema::create('Devices', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name', 100); // Device name
            $table->integer('year_of_manufacture'); // Year of manufacture
            $table->date('purchase_date'); // Purchase date
            $table->integer('max_loan_duration'); // Maximum loan duration in days
            $table->boolean('available')->default(true); // Availability status
            $table->unsignedBigInteger('type_id'); // Foreign key to Device_Types
            $table->unsignedBigInteger('studio_id'); // Foreign key to Studios
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key to Users
            $table->timestamps(); // created_at and updated_at
            // Define foreign keys
            $table->foreign('type_id')->references('id')->on('Device_Types')->onDelete('cascade');
            $table->foreign('studio_id')->references('id')->on('Studios')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('Users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Devices');
    }
};
