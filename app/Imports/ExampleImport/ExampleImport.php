<?php

declare(strict_types=1);

namespace App\Imports\ExampleImport;

use App\Imports\BaseImport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException as ValidationExceptionAlias;
use Maatwebsite\Excel\Concerns\ToModel;
use Throwable;

class ExampleImport extends BaseImport implements ToModel
{
    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            'cep',
            'rua',
            'uf',
            'bairro',
            'cidade',
            'numero',
            'complemento'
        ];
    }

    /**
     * Exemplo usaddo na tabela de "Address"
     *
     * @param array $row
     */
    public function model(array $row): void
    {
        DB::table('address')->insert([
            'uid_address' => Str::uuid()->toString(),
            'zip_code' => data_get($row, 'cep'),
            "street" => data_get($row, 'rua'),
            "city" => data_get($row, 'cidade'),
            "district" => data_get($row, 'bairro'),
            'number' => data_get($row, 'numero'),
            'uf' => data_get($row, 'uf'),
            'complement' => data_get($row, "complemento")
        ]);
    }

    /**
     * @param Collection $collection
     * @throws Throwable
     */
    public function customValidationColumns(Collection $collection): void
    {
        $collection->each(function ($collection) {
            $headers = $collection->first();

            $headers->each(function ($value) {
                if (!in_array(strtolower($value), $this->columns())) {
                    $this->errors[] = "Campo '{$value}' não é valido para essa importação";
                }
            });
        });

       throw_if(!empty($this->errors), ValidationExceptionAlias::withMessages($this->errors));
    }
}
