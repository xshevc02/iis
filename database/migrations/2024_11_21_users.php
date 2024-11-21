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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('username'); // Add username field
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id'); // Foreign key for roles
            $table->unsignedBigInteger('studio_id')->nullable(); // Foreign key for studios
            $table->rememberToken();
            $table->timestamps();

            // Define foreign keys
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            $table->foreign('studio_id')->references('id')->on('studio')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
