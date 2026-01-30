<?php

namespace App\Http\Controllers;

use App\Models\ToolSetting;
use App\Models\ServerSetting;
use App\Models\User;
use App\Models\UserToolPermission;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $tools = ToolSetting::orderBy('sort_order')->get();
        $serverSettings = ServerSetting::all();

        // Exclude admin users from the permissions matrix (admins already have full access)
        $users = User::where('role', '!=', 'admin')->orderBy('name')->get();

        // Build permissions map: [user_id => [tool_name => allowed]]
        $permissions = [];
        $allPerms = UserToolPermission::with('tool')->get();
        foreach ($allPerms as $p) {
            $permissions[$p->user_id][$p->tool->tool_name] = (bool)$p->allowed;
        }
        
        // Get current runtime config values
        $currentConfig = [
            'db_engine' => config('database.default'),
            'db_server' => config('database.connections.sqlsrv.host'),
            'db_port' => config('database.connections.sqlsrv.port'),
            'db_instance' => config('database.connections.sqlsrv.database'),
            'db_username' => config('database.connections.sqlsrv.username'),
            'db_password' => config('database.connections.sqlsrv.password'),
            'wamas_prod' => $serverSettings->where('key', 'wamas_prod')->first()?->value ?? '',
            'wamas_view' => $serverSettings->where('key', 'wamas_view')->first()?->value ?? '',
            'wamas_arch' => $serverSettings->where('key', 'wamas_arch')->first()?->value ?? '',
        ];
        
        return view('site.settings', compact('tools', 'serverSettings', 'currentConfig', 'users', 'permissions'));
    }

    public function toggle(Request $request)
    {
        $tool = ToolSetting::where('tool_name', $request->tool_name)->first();
        
        if ($tool) {
            $tool->update(['is_visible' => !$tool->is_visible]);
            return response()->json(['success' => true, 'is_visible' => $tool->is_visible]);
        }

        return response()->json(['success' => false], 404);
    }

    public function updateServerSetting(Request $request)
    {
        $setting = ServerSetting::where('key', $request->key)->first();
        
        if ($setting) {
            $setting->update(['value' => $request->value]);
            return response()->json(['success' => true, 'message' => 'Configuração atualizada com sucesso']);
        }

        return response()->json(['success' => false], 404);
    }

    public function setPermission(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'tool_name' => 'required|string|exists:tool_settings,tool_name',
            'allowed' => 'required|boolean',
        ]);

        $tool = ToolSetting::where('tool_name', $validated['tool_name'])->first();

        $perm = UserToolPermission::updateOrCreate(
            [
                'user_id' => $validated['user_id'],
                'tool_setting_id' => $tool->id,
            ],
            [
                'allowed' => $validated['allowed'],
            ]
        );

        return response()->json(['success' => true, 'permission' => $perm]);
    }
}
