<?php

namespace App\Http\Controllers;

use App\Models\ToolSetting;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        $allTools = ToolSetting::orderBy('sort_order')->get();

        $visibleTools = collect();

        if (auth()->check()) {
            /** @var User|null $user */
            $user = auth()->user();

            if (! $user instanceof User) {
                $visibleTools = collect();
            } else {
                // Admin sees all tools
                if (($user->role ?? 'client') === 'admin') {
                    $visibleTools = $allTools;
                } else {
                    // Non-admins see tools that are globally visible AND that they have permission for
                    $visibleTools = $allTools->filter(function ($tool) use ($user) {
                        return $tool->is_visible && $user->hasTool($tool->tool_name);
                    })->values();
                }
            }
        }

        return view('site/home', compact('visibleTools'));
    }
}