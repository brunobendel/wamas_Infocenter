<?php

namespace App\Console\Commands;

use App\Models\ToolSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateToolSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-tool-settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate tool settings table with default tools';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tools = [
            [
                'tool_name' => 'integracao',
                'tool_label' => 'Integração',
                'icon_path' => '/images/test.png',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'tool_name' => 'grupo_p2l_prateleira',
                'tool_label' => 'GRUPO P2L PRATELEIRA',
                'icon_path' => '/images/P2L.png',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'tool_name' => 'compartimentos',
                'tool_label' => 'COMPARTIMENTOS',
                'icon_path' => '/images/compartimentos.png',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'tool_name' => 'desbloquear_compartimentos',
                'tool_label' => 'DESBLOQUEAR COMPARTIMENTOS',
                'icon_path' => '/images/unlock.png',
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'tool_name' => 'cubatura_item',
                'tool_label' => 'CUBATURA ITEM P/ CAIXA',
                'icon_path' => '/images/cubatura.png',
                'is_visible' => true,
                'sort_order' => 5,
            ],
            [
                'tool_name' => 'escaneie_pegar_guardar',
                'tool_label' => 'ESCANEIE P/ PEGAR/GUARDAR',
                'icon_path' => '/images/barcode.png',
                'is_visible' => true,
                'sort_order' => 6,
            ],
            [
                'tool_name' => 'terminais',
                'tool_label' => 'TERMINAIS',
                'icon_path' => '/images/terminais.png',
                'is_visible' => true,
                'sort_order' => 7,
            ],
            [
                'tool_name' => 'estoque_minimo',
                'tool_label' => 'Gerenciamento de Estoque Mínimo',
                'icon_path' => '/images/inventory.png',
                'is_visible' => true,
                'sort_order' => 8,
            ],
            [
                'tool_name' => 'estatisticas',
                'tool_label' => 'Estatísticas',
                'icon_path' => '/images/report.png',
                'is_visible' => true,
                'sort_order' => 9,
            ],
            [
                'tool_name' => 'importacao_planilha',
                'tool_label' => 'Importação de planilha',
                'icon_path' => '/images/Importação de planilha.png',
                'is_visible' => true,
                'sort_order' => 10,
            ],
            [
                'tool_name' => 'erros_interface',
                'tool_label' => 'ERROS DE INTERFACE',
                'icon_path' => '/images/error.png',
                'is_visible' => true,
                'sort_order' => 11,
            ],
            [
                'tool_name' => 'manuais',
                'tool_label' => 'MANUAIS',
                'icon_path' => '/images/manuais.png',
                'is_visible' => true,
                'sort_order' => 12,
            ],
        ];

        // Clear existing data
        ToolSetting::truncate();

        // Insert fresh data without timestamps - let the database handle defaults
        foreach ($tools as $tool) {
            DB::statement(
                "INSERT INTO tool_settings (tool_name, tool_label, icon_path, is_visible, sort_order) 
                 VALUES (?, ?, ?, ?, ?)",
                [
                    $tool['tool_name'],
                    $tool['tool_label'],
                    $tool['icon_path'],
                    $tool['is_visible'] ? 1 : 0,
                    $tool['sort_order'],
                ]
            );
        }

        $this->info('Tool settings populated successfully!');
    }
}
