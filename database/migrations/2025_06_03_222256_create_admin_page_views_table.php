<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPageViewsTable extends Migration
{
    public function up()
    {
        Schema::create('admin_page_views', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name', 255); // Admin name from session
            $table->string('ip_address', 45); // Supports IPv4 and IPv6
            $table->string('session_id', 255)->nullable(); // Session ID for uniqueness
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_page_views');
    }
}