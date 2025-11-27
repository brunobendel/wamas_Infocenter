<?php

namespace Database\Seeders;

use App\Models\ServerSetting;
use Illuminate\Database\Seeder;

class ServerSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'db_engine', 'label' => 'DB Engine', 'value' => 'mssql', 'type' => 'text'],
            ['key' => 'db_server', 'label' => 'DB Server', 'value' => 'localhost', 'type' => 'text'],
            ['key' => 'db_port', 'label' => 'DB Port', 'value' => '1433', 'type' => 'number'],
            ['key' => 'db_instance', 'label' => 'DB Instance', 'value' => 'SQLEXPRESS', 'type' => 'text'],
            ['key' => 'db_username', 'label' => 'DB Username', 'value' => 'sa', 'type' => 'text'],
            ['key' => 'db_password', 'label' => 'DB Password', 'value' => '', 'type' => 'text'],
            ['key' => 'wamas_prod', 'label' => 'WAMAS Production DB', 'value' => 'wlm27_prod', 'type' => 'text'],
            ['key' => 'wamas_view', 'label' => 'WAMAS View DB', 'value' => 'wlm27_view', 'type' => 'text'],
            ['key' => 'wamas_arch', 'label' => 'WAMAS Archive DB', 'value' => 'wlm27_arch', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            ServerSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
