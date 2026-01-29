<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop default constraints for created_at and updated_at if they exist
        DB::statement("
            DECLARE @df nvarchar(128);
            SELECT @df = dc.name
            FROM sys.default_constraints dc
            JOIN sys.columns c ON dc.parent_object_id = c.object_id AND dc.parent_column_id = c.column_id
            WHERE OBJECT_NAME(dc.parent_object_id) = 'tool_settings' AND c.name = 'created_at';
            IF @df IS NOT NULL EXEC('ALTER TABLE tool_settings DROP CONSTRAINT ' + @df);
        ");

        DB::statement("
            DECLARE @df nvarchar(128);
            SELECT @df = dc.name
            FROM sys.default_constraints dc
            JOIN sys.columns c ON dc.parent_object_id = c.object_id AND dc.parent_column_id = c.column_id
            WHERE OBJECT_NAME(dc.parent_object_id) = 'tool_settings' AND c.name = 'updated_at';
            IF @df IS NOT NULL EXEC('ALTER TABLE tool_settings DROP CONSTRAINT ' + @df);
        ");

        // Alter columns to datetime2(3)
        DB::statement("IF COL_LENGTH('tool_settings', 'created_at') IS NOT NULL ALTER TABLE tool_settings ALTER COLUMN created_at datetime2(3) NULL");
        DB::statement("IF COL_LENGTH('tool_settings', 'updated_at') IS NOT NULL ALTER TABLE tool_settings ALTER COLUMN updated_at datetime2(3) NULL");

        // Recreate default constraints using SYSUTCDATETIME()
        DB::statement("ALTER TABLE tool_settings ADD CONSTRAINT DF_tool_settings_created_at DEFAULT (SYSUTCDATETIME()) FOR created_at");
        DB::statement("ALTER TABLE tool_settings ADD CONSTRAINT DF_tool_settings_updated_at DEFAULT (SYSUTCDATETIME()) FOR updated_at");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No safe automatic revert; leave as datetime2
    }
};
