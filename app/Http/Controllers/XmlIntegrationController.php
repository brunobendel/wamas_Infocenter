<?php

namespace App\Http\Controllers;

use App\Models\XmlIntegration;
use App\Services\XmlGeneratorService;
use Illuminate\Http\Request;

class XmlIntegrationController extends Controller
{
    protected $xmlGenerator;

    public function __construct(XmlGeneratorService $xmlGenerator)
    {
        $this->xmlGenerator = $xmlGenerator;
    }

    /**
     * Gera XML para um item específico
     */
    public function generateXml(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'base_qty_unit' => 'nullable|string|max:10',
            'variant' => 'nullable|string|max:10',
            'client_id' => 'nullable|string|max:50',
        ]);

        try {
            $xmlIntegration = $this->xmlGenerator->generateAndSaveXml(
                $validated['sku'],
                $validated['description'],
                $validated['base_qty_unit'] ?? 'PCS',
                $validated['variant'] ?? '00000',
                $validated['client_id'] ?? 'BRUNO'
            );

            return response()->json([
                'success' => true,
                'message' => 'XML gerado e inserido com sucesso',
                'label' => 'Inserção com sucesso!',
                'data' => [
                    'sequence' => $xmlIntegration->id,
                    'id' => $xmlIntegration->id,
                    'data' => $xmlIntegration->xml_content,
                    'sku' => $xmlIntegration->sku,
                    'status' => $xmlIntegration->status,
                    'created_at' => $xmlIntegration->created_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao gerar XML: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Gera XMLs em lote
     */
    public function generateBatchXml(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.sku' => 'required|string|max:100',
            'items.*.description' => 'required|string|max:500',
            'items.*.base_qty_unit' => 'nullable|string|max:10',
            'items.*.variant' => 'nullable|string|max:10',
            'client_id' => 'nullable|string|max:50',
        ]);

        try {
            $clientId = $validated['client_id'] ?? 'BRUNO';
            $results = $this->xmlGenerator->generateAndSaveMultipleXmls(
                $validated['items'],
                $clientId
            );

            return response()->json([
                'success' => true,
                'message' => count($results) . ' XMLs gerados com sucesso',
                'data' => $results
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao gerar XMLs: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lista todos os XMLs gerados
     */
    public function listXmls()
    {
        $xmls = XmlIntegration::orderByDesc('created_at')->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $xmls
        ]);
    }

    /**
     * Obtém um XML específico
     */
    public function getXml(XmlIntegration $xmlIntegration)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $xmlIntegration->id,
                'sku' => $xmlIntegration->sku,
                'variant' => $xmlIntegration->variant,
                'description' => $xmlIntegration->description,
                'xml_content' => $xmlIntegration->xml_content,
                'status' => $xmlIntegration->status,
                'created_at' => $xmlIntegration->created_at,
            ]
        ]);
    }

    /**
     * Atualiza o status do XML (pending, sent, failed)
     */
    public function updateStatus(XmlIntegration $xmlIntegration, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,sent,failed',
        ]);

        $xmlIntegration->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Status atualizado com sucesso',
            'data' => $xmlIntegration
        ]);
    }

    /**
     * Download do XML em arquivo
     */
    public function downloadXml(XmlIntegration $xmlIntegration)
    {
        return response($xmlIntegration->xml_content)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'attachment; filename="item_' . $xmlIntegration->sku . '.xml"');
    }

    /**
     * Deleta um XML gerado
     */
    public function deleteXml(XmlIntegration $xmlIntegration)
    {
        $xmlIntegration->delete();

        return response()->json([
            'success' => true,
            'message' => 'XML deletado com sucesso'
        ]);
    }

    /**
     * Gera INSERT SQL para SQL Server
     */
    public function generateSqlInsert(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'base_qty_unit' => 'nullable|string|max:10',
            'variant' => 'nullable|string|max:10',
            'client_id' => 'nullable|string|max:50',
            'sequence' => 'nullable|integer',
            'id' => 'nullable|integer',
        ]);

        try {
            $sql = $this->xmlGenerator->generateSqlInsert(
                $validated['sku'],
                $validated['description'],
                $validated['base_qty_unit'] ?? 'PCS',
                $validated['variant'] ?? '00000',
                $validated['client_id'] ?? 'BRUNO',
                $validated['sequence'] ?? 1,
                $validated['id'] ?? 1
            );

            return response()->json([
                'success' => true,
                'message' => 'INSERT SQL gerado com sucesso',
                'data' => [
                    'sql' => $sql,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao gerar INSERT SQL: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Gera múltiplos INSERTs SQL para SQL Server
     */
    public function generateBatchSqlInsert(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.sku' => 'required|string|max:100',
            'items.*.description' => 'required|string|max:500',
            'items.*.base_qty_unit' => 'nullable|string|max:10',
            'items.*.variant' => 'nullable|string|max:10',
            'client_id' => 'nullable|string|max:50',
            'start_sequence' => 'nullable|integer',
        ]);

        try {
            $inserts = $this->xmlGenerator->generateMultipleSqlInserts(
                $validated['items'],
                $validated['client_id'] ?? 'BRUNO',
                $validated['start_sequence'] ?? 1
            );

            return response()->json([
                'success' => true,
                'message' => count($inserts) . ' INSERTs SQL gerados com sucesso',
                'data' => [
                    'inserts' => $inserts,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao gerar INSERTs SQL: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Endpoint simples para inserir um item e retornar label de sucesso
     */
    public function insertItem(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'base_qty_unit' => 'nullable|string|max:10',
            'variant' => 'nullable|string|max:10',
            'client_id' => 'nullable|string|max:50',
        ]);

        try {
            $xmlIntegration = $this->xmlGenerator->generateAndSaveXml(
                $validated['sku'],
                $validated['description'],
                $validated['base_qty_unit'] ?? 'PCS',
                $validated['variant'] ?? '00000',
                $validated['client_id'] ?? 'BRUNO'
            );

            return response()->json([
                'success' => true,
                'label' => '✓ Inserção com sucesso!',
                'details' => [
                    'sequence' => $xmlIntegration->id,
                    'id' => $xmlIntegration->id,
                    'data' => $xmlIntegration->xml_content,
                ],
                'summary' => [
                    'sku' => $xmlIntegration->sku,
                    'variant' => $xmlIntegration->variant,
                    'description' => $xmlIntegration->description,
                    'base_qty_unit' => $xmlIntegration->base_qty_unit,
                    'status' => $xmlIntegration->status,
                    'inserted_at' => $xmlIntegration->created_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'label' => '✗ Erro na inserção',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
