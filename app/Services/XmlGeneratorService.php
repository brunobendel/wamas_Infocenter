<?php

namespace App\Services;

use App\Models\XmlIntegration;
use SimpleXMLElement;
use Illuminate\Support\Facades\DB;

class XmlGeneratorService
{
    /**
     * Gera XML no formato WAMAS com LogimatItemGroup
     */
    public function generateXml(string $sku, string $description, string $baseQtyUnit = 'PCS', string $variant = '00000', string $clientId = 'BRUNO'): string
    {
        // Criar o elemento raiz
        $xml = new SimpleXMLElement('<?xml version="1.0"?><DI_TELEGRAM></DI_TELEGRAM>');

        // Adicionar header
        $header = $xml->addChild('header');
        $full = $header->addChild('FULL');
        $full->addChild('HEADER_SOURCE', 'HOST');
        $full->addChild('HEADER_DESTINATION', 'WAMAS');
        $full->addChild('HEADER_SEQUENCE'); // Vazio como no exemplo
        $full->addChild('HEADER_RECORDTYPENAME', 'WLSITEM001');

        // Adicionar body com LogimatItemGroup
        $body = $xml->addChild('body');
        $itemGroup = $body->addChild('LogimatItemGroup');
        $item = $itemGroup->addChild('WLSITEM001');

        // Preencher dados do item
        $item->addChild('clientId', $clientId);
        $item->addChild('itemNo', $sku); // SKU como itemNo
        $item->addChild('variant', $variant);
        $item->addChild('baseQtyUnit', $baseQtyUnit);
        $item->addChild('itemType', 'MERC');

        // Retornar XML formatado
        return $this->formatXml($xml->asXML());
    }

    /**
     * Gera XML para Armazenamento (WLSSD001) — estrutura inicial, ajustável depois
     */
    public function generateStorageXml(string $sku, string $description, string $baseQtyUnit = 'PCS', string $variant = '00000', string $clientId = 'BRUNO'): string
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><DI_TELEGRAM></DI_TELEGRAM>');

        $header = $xml->addChild('header');
        $full = $header->addChild('FULL');
        $full->addChild('HEADER_SOURCE', 'HOST');
        $full->addChild('HEADER_DESTINATION', 'WAMAS');
        $full->addChild('HEADER_SEQUENCE');
        $full->addChild('HEADER_RECORDTYPENAME', 'WLSSD001');

        $body = $xml->addChild('body');
        $group = $body->addChild('StorageGroup');
        $item = $group->addChild('WLSSD001');

        $item->addChild('clientId', $clientId);
        $item->addChild('itemNo', $sku);
        $item->addChild('variant', $variant);
        $item->addChild('baseQtyUnit', $baseQtyUnit);
        $item->addChild('storageAction', 'PUTAWAY');

        return $this->formatXml($xml->asXML());
    }

    /**
     * Gera XML para Picking (WLSPD001) — estrutura inicial, ajustável depois
     */
    public function generatePickingXml(string $sku, string $description, string $baseQtyUnit = 'PCS', string $variant = '00000', string $clientId = 'BRUNO'): string
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><DI_TELEGRAM></DI_TELEGRAM>');

        $header = $xml->addChild('header');
        $full = $header->addChild('FULL');
        $full->addChild('HEADER_SOURCE', 'HOST');
        $full->addChild('HEADER_DESTINATION', 'WAMAS');
        $full->addChild('HEADER_SEQUENCE');
        $full->addChild('HEADER_RECORDTYPENAME', 'WLSPD001');

        $body = $xml->addChild('body');
        $group = $body->addChild('PickingGroup');
        $item = $group->addChild('WLSPD001');

        $item->addChild('clientId', $clientId);
        $item->addChild('itemNo', $sku);
        $item->addChild('variant', $variant);
        $item->addChild('baseQtyUnit', $baseQtyUnit);
        $item->addChild('pickQuantity', '0');

        return $this->formatXml($xml->asXML());
    }

    /**
     * Gera XML para Inventário (WLSINVD001) — estrutura inicial, ajustável depois
     */
    public function generateInventoryXml(string $sku, string $description, string $baseQtyUnit = 'PCS', string $variant = '00000', string $clientId = 'BRUNO'): string
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><DI_TELEGRAM></DI_TELEGRAM>');

        $header = $xml->addChild('header');
        $full = $header->addChild('FULL');
        $full->addChild('HEADER_SOURCE', 'HOST');
        $full->addChild('HEADER_DESTINATION', 'WAMAS');
        $full->addChild('HEADER_SEQUENCE');
        $full->addChild('HEADER_RECORDTYPENAME', 'WLSINVD001');

        $body = $xml->addChild('body');
        $group = $body->addChild('InventoryGroup');
        $item = $group->addChild('WLSINVD001');

        $item->addChild('clientId', $clientId);
        $item->addChild('itemNo', $sku);
        $item->addChild('variant', $variant);
        $item->addChild('baseQtyUnit', $baseQtyUnit);
        $item->addChild('inventoryCount', '0');

        return $this->formatXml($xml->asXML());
    }

    /**
     * Formata o XML com indentação correta
     */
    private function formatXml(string $xml): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->load('data://text/plain;base64,' . base64_encode($xml));
        $dom->formatOutput = true;

        return $dom->saveXML();
    }

    /**
     * Gera XML e armazena na tabela
     */
    public function generateAndSaveXml(string $sku, string $description, string $baseQtyUnit = 'PCS', string $variant = '00000', string $clientId = 'BRUNO', string $recordType = 'WLSITEM001'): XmlIntegration
    {
        switch ($recordType) {
            case 'WLSSD001':
                $xmlContent = $this->generateStorageXml($sku, $description, $baseQtyUnit, $variant, $clientId);
                break;
            case 'WLSPD001':
                $xmlContent = $this->generatePickingXml($sku, $description, $baseQtyUnit, $variant, $clientId);
                break;
            case 'WLSINVD001':
                $xmlContent = $this->generateInventoryXml($sku, $description, $baseQtyUnit, $variant, $clientId);
                break;
            case 'WLSITEM001':
            default:
                $xmlContent = $this->generateXml($sku, $description, $baseQtyUnit, $variant, $clientId);
                break;
        }

        // Verificar se já existe um registro com o mesmo SKU
        $existing = XmlIntegration::where('sku', $sku)->first();

        if ($existing) {
            // Atualizar o registro existente (sem tocar created_at) usando id
            DB::update(
                "UPDATE xml_integrations SET variant = ?, description = ?, base_qty_unit = ?, xml_content = ?, client_id = ?, status = ?, record_type = ?, updated_at = GETDATE() WHERE id = ?",
                [
                    $variant,
                    $description,
                    $baseQtyUnit,
                    $xmlContent,
                    $clientId,
                    'pending',
                    $recordType,
                    $existing->id,
                ]
            );

            return XmlIntegration::find($existing->id);
        }

        // Inserir novo registro (SQL Server definirá created_at/updated_at via DEFAULT GETDATE())
        DB::insert(
            "INSERT INTO xml_integrations 
            (sku, variant, description, base_qty_unit, xml_content, client_id, status, record_type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $sku,
                $variant,
                $description,
                $baseQtyUnit,
                $xmlContent,
                $clientId,
                'pending',
                $recordType,
            ]
        );

        return XmlIntegration::where('sku', $sku)
            ->orderByDesc('id')
            ->first();
    }

    /**
     * Gera múltiplos XMLs a partir de um array de itens
     */
    public function generateAndSaveMultipleXmls(array $items, string $clientId = 'BRUNO', string $recordType = 'WLSITEM001'): array
    {
        $results = [];
        foreach ($items as $item) {
            $results[] = $this->generateAndSaveXml(
                $item['sku'],
                $item['description'],
                $item['base_qty_unit'] ?? 'PCS',
                $item['variant'] ?? '00000',
                $clientId,
                $recordType
            );
        }
        return $results;
    }

    /**
     * Gera um INSERT SQL para SQL Server
     */
    public function generateSqlInsert(string $sku, string $description, string $baseQtyUnit = 'PCS', string $variant = '00000', string $clientId = 'BRUNO', int $sequence = 1, int $id = 1, string $recordType = 'WLSITEM001'): string
    {
        switch ($recordType) {
            case 'WLSSD001':
                $xmlContent = $this->generateStorageXml($sku, $description, $baseQtyUnit, $variant, $clientId);
                break;
            case 'WLSPD001':
                $xmlContent = $this->generatePickingXml($sku, $description, $baseQtyUnit, $variant, $clientId);
                break;
            case 'WLSINVD001':
                $xmlContent = $this->generateInventoryXml($sku, $description, $baseQtyUnit, $variant, $clientId);
                break;
            case 'WLSITEM001':
            default:
                $xmlContent = $this->generateXml($sku, $description, $baseQtyUnit, $variant, $clientId);
                break;
        }
        
        // Escapar aspas simples para SQL
        $xmlContent = str_replace("'", "''", $xmlContent);
        
        $sql = "INSERT INTO bruno_prod.dbo.SysPartner2WamasData01 ([sequence], id, [data]) VALUES($sequence, $id, N'$xmlContent');";
        
        return $sql;
    }

    /**
     * Gera múltiplos INSERTs SQL para SQL Server
     */
    public function generateMultipleSqlInserts(array $items, string $clientId = 'BRUNO', int $startSequence = 1, string $recordType = 'WLSITEM001'): array
    {
        $inserts = [];
        foreach ($items as $index => $item) {
            $inserts[] = $this->generateSqlInsert(
                $item['sku'],
                $item['description'],
                $item['base_qty_unit'] ?? 'PCS',
                $item['variant'] ?? '00000',
                $clientId,
                $startSequence + $index,
                $index + 1,
                $recordType
            );
        }
        return $inserts;
    }
}
