<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolSetting extends Model
{
    protected $table = 'tool_settings';

    protected $fillable = [
        'tool_name',
        'tool_label',
        'icon_path',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];
}

