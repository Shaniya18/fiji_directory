<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add auth_token to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('auth_token', 100)->nullable()->after('password');
        });

        // Add region and tags to submissions table
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('region', 100)->nullable()->after('website_url');
            $table->string('tags')->nullable()->after('region');
        });

        // Add region and tags to listings table
        Schema::table('listings', function (Blueprint $table) {
            $table->string('region', 100)->nullable()->after('website_url');
            $table->string('tags')->nullable()->after('region');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('auth_token');
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn(['region', 'tags']);
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn(['region', 'tags']);
        });
    }
};