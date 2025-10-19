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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->text('description');
            $table->string('contact_email');
            $table->string('phone_number', 50);
            $table->string('website_url')->nullable();
            // The ENUM type for status, with a default of 'pending'.
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            // Foreign key to the categories table.
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            // Foreign key to the users table.
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Automatically adds `created_at` (your submission_date) and `updated_at`.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
