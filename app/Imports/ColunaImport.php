<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ColunaImport implements ToCollection
{
    public $itens = [];
    public $quantidades = [];

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Supondo que a primeira linha seja o cabeçalho
        $header = $collection->first();

        $colIndexItens = $header->search('itens');
        $colIndexQuant = $header->search('quantidade');

        if ($colIndexItens !== false && $colIndexQuant !== false) {
            foreach ($collection->skip(1) as $row) {
                $this->itens[] = $row[$colIndexItens];
                $this->quantidades[] = $row[$colIndexQuant];
            }
        }
    }
}
