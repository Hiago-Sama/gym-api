<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Imports\ExampleImport\ExampleImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as JsonResponse;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class ExampleImportController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $file = $request->file('file');
            $addressImport = new ExampleImport;

            $heads = (new HeadingRowImport())->toCollection($file);
            $addressImport->customValidationColumns($heads);

            Excel::import($addressImport, $file);

        } catch (ValidationException $exception) {
            return JsonResponse::json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => 'Erro ao importar o arquivo',
                'error' => $exception->errors()
            ]);
        }

        return JsonResponse::json([
            'code' => Response::HTTP_OK,
            'message' => 'Importação realizada com sucesso'
        ]);
    }
}
