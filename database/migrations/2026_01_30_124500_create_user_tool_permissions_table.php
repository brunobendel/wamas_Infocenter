<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_tool_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tool_setting_id');
            $table->boolean('allowed')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tool_setting_id')->references('id')->on('tool_settings')->onDelete('cascade');
        });

        // Add created_at/updated_at with SQL Server default
        DB::statement("ALTER TABLE user_tool_permissions ADD created_at DATETIME DEFAULT GETDATE()");
        DB::statement("ALTER TABLE user_tool_permissions ADD updated_at DATETIME DEFAULT GETDATE()");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tool_permissions');
    }
};
