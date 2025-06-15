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
Schema::create('email_receivers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Name column
            $table->string('email')->unique(); // Email column, unique to prevent duplicates
            $table->timestamps(); // Created_at and updated_at columns
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
