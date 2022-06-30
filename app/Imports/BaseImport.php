<?php

declare(strict_types=1);

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

abstract class BaseImport implements WithHeadingRow, WithBatchInserts
{
    protected $mapping = 1;

    protected $errors = [];

    use Importable;

    /**
     * Linha que começará a leitura do arquivo
     *
     * @return int
     */
    public function headingRow()
    {
        return $this->mapping;
    }


    /**
     * Quantidade de linhas por processamento
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 100;
    }
}
