<?php

namespace App\Http\Controllers;

use App\Models\ToolSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        $visibleTools = ToolSetting::where('is_visible', true)
            ->orderBy('order')
            ->get();
        
        return view('site/home', compact('visibleTools'));
    }
}
