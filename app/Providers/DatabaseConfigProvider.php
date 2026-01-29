<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ServerSetting;
use Illuminate\Support\Facades\Log;

class DatabaseConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load server settings from database and apply to config
        try {
            $settings = ServerSetting::all()->keyBy('key');

            if ($settings->isNotEmpty()) {
                $driver = $settings->get('db_engine')?->value ?? config('database.default');
                $host = $settings->get('db_server')?->value ?? config("database.connections.{$driver}.host");
                $port = $settings->get('db_port')?->value ?? config("database.connections.{$driver}.port");
                $database = $settings->get('db_instance')?->value ?? config("database.connections.{$driver}.database");
                $username = $settings->get('db_username')?->value ?? config("database.connections.{$driver}.username");
                $password = $settings->get('db_password')?->value ?? config("database.connections.{$driver}.password");

                // Update the active database configuration
                config([
                    "database.connections.{$driver}.host" => $host,
                    "database.connections.{$driver}.port" => (int) $port,
                    "database.connections.{$driver}.database" => $database,
                    "database.connections.{$driver}.username" => $username,
                    "database.connections.{$driver}.password" => $password,
                ]);

                // Purge the connection to force reconnection with new config
                \Illuminate\Support\Facades\DB::purge($driver);
            }
        } catch (\Exception $e) {
            // If table doesn't exist or other error, continue with default config
            Log::warning('Failed to load server settings from database', ['error' => $e->getMessage()]);
        }
    }
}
