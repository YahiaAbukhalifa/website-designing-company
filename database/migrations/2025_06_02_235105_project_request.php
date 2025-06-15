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
        Schema::create('project_requests', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('full_name'); // Full name column
            $table->string('phone_number'); // Phone number column
            $table->string('email'); // Email column
            $table->string('project_status'); // Project status column
            $table->decimal('land_area', 10, 2); // Land area column (decimal for measurements)
            $table->string('city'); // City column
            $table->string('district'); // District column
            $table->string('project_category'); // Project category column
            $table->integer('number_of_flats'); // Number of flats column
            $table->integer('cellar_count'); // Cellar count column
            $table->boolean('ground_floor')->default(false); // Yes/No for Ground floor
            $table->boolean('first_round')->default(false); // Yes/No for First round
            $table->boolean('upper_annex')->default(false); // Yes/No for Upper annex
            $table->boolean('drivers_room')->default(false); // Yes/No for Driver's room
            $table->boolean('swimming_pool')->default(false); // Yes/No for Swimming pool
            $table->boolean('mens_diwaniya')->default(false); // Yes/No for Men's Diwaniya
            $table->boolean('womens_diwaniya')->default(false); // Yes/No for Women's Diwaniya
            $table->boolean('parking')->default(false); // Yes/No for Parking
            $table->boolean('multiple_floors')->default(false); // Yes/No for Multiple floors
            $table->integer('floor_count')->nullable(); // Floor count column (nullable if multiple_floors is false)
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
