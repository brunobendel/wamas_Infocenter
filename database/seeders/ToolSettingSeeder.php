<?php

namespace Database\Seeders;

use App\Models\ToolSetting;
use Illuminate\Database\Seeder;

class ToolSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            [
                'tool_name' => 'integracao',
                'tool_label' => 'Integração Manual',
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

        foreach ($tools as $tool) {
            ToolSetting::updateOrCreate(
                ['tool_name' => $tool['tool_name']],
                $tool
            );
        }
    }
}
