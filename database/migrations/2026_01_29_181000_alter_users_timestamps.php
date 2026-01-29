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
            WHERE OBJECT_NAME(dc.parent_object_id) = 'users' AND c.name = 'created_at';
            IF @df IS NOT NULL EXEC('ALTER TABLE users DROP CONSTRAINT ' + @df);
        ");

        DB::statement("
            DECLARE @df nvarchar(128);
            SELECT @df = dc.name
            FROM sys.default_constraints dc
            JOIN sys.columns c ON dc.parent_object_id = c.object_id AND dc.parent_column_id = c.column_id
            WHERE OBJECT_NAME(dc.parent_object_id) = 'users' AND c.name = 'updated_at';
            IF @df IS NOT NULL EXEC('ALTER TABLE users DROP CONSTRAINT ' + @df);
        ");

        // Alter columns to datetime2(3)
        DB::statement("IF COL_LENGTH('users', 'created_at') IS NOT NULL ALTER TABLE users ALTER COLUMN created_at datetime2(3) NULL");
        DB::statement("IF COL_LENGTH('users', 'updated_at') IS NOT NULL ALTER TABLE users ALTER COLUMN updated_at datetime2(3) NULL");

        // Recreate default constraints using SYSUTCDATETIME()
        DB::statement("ALTER TABLE users ADD CONSTRAINT DF_users_created_at DEFAULT (SYSUTCDATETIME()) FOR created_at");
        DB::statement("ALTER TABLE users ADD CONSTRAINT DF_users_updated_at DEFAULT (SYSUTCDATETIME()) FOR updated_at");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No safe automatic revert; leave as datetime2
    }
};
