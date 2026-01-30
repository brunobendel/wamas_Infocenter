<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XmlIntegration extends Model
{
    use HasFactory;

    protected $table = 'xml_integrations';

    // Desabilitar timestamps automáticos
    public $timestamps = false;

    protected $fillable = [
        'sequence',
        'sku',
        'variant',
        'description',
        'base_qty_unit',
        'xml_content',
        'status',
        'record_type',
        'client_id',
        'created_at',
        'updated_at',
    ];
}
