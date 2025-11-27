<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ColunaImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importForm()
    {
        return view('site/importar-excel');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|file|mimes:xlsx,xls'
        ]);

        $import = new ColunaImport;
        Excel::import($import, $request->file('arquivo'));

        // Agora você pode acessar os dados importados:
        $itens = $import->itens;
        $quantidades = $import->quantidades;

        // Exemplo: visualizar os dados
        var_dump($itens, $quantidades);


        // Aqui você pode usar os dados como quiser, salvar no banco, etc.

        return view('site/importar-excel', compact('itens', 'quantidades'))->with('success', 'Arquivo importado com sucesso!');
    }
}
