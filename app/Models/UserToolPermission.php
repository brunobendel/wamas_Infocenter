<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToolPermission extends Model
{
    protected $table = 'user_tool_permissions';

    protected $fillable = [
        'user_id',
        'tool_setting_id',
        'allowed',
    ];

    // Let SQL Server populate created_at/updated_at via DEFAULT GETDATE()
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tool()
    {
        return $this->belongsTo(ToolSetting::class, 'tool_setting_id');
    }
}
