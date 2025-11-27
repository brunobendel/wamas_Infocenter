<?php

namespace App\Http\Controllers;

use App\Models\ToolSetting;
use App\Models\ServerSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $tools = ToolSetting::orderBy('order')->get();
        $serverSettings = ServerSetting::all();
        
        return view('site.settings', compact('tools', 'serverSettings'));
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
}
