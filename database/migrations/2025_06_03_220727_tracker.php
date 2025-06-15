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
Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('url', 255); // Page URL (e.g., /home, /portfolio)
            $table->string('ip_address', 45); // Supports IPv4 and IPv6
            $table->string('session_id', 255)->nullable(); // Session ID for uniqueness
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
