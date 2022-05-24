<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Exceptions\Config\BaseException;
use App\Exceptions\Config\BuildExceptions;
use App\Exceptions\DefaultException;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class AddressRequest extends FormRequest
{
    /**
     * Autorização para uso da request
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Campos obrigatórios
     *
     * @return mixed
     */
    public function rules(): array
    {
        return [
            'zip_code' => 'required',
            'street' => 'required',
            'city' => 'required',
            'district' => 'required',
            'number' => 'required',
            'uf' => 'required',
            'complement' => 'nullable'
        ];
    }

    /**
     * Menssagem para campos obrigátorios em caso de inexistencia
     *
     * @return mixed
     */
    public function messages(): array
    {
        return [
            'zip_code.required' => "Deve conter o CEP",
            'street.required' => "Deve conter a Rua",
            'city.required' => "Deve conter Cidade",
            'district.required' => "Deve conter Bairro",
            'number.required' => "Deve conter numero",
            'uf.required' => "Deve conter UF",
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws TransferException
     * @throws BuildExceptions
     */
    protected function failedValidation(Validator $validator): void
    {
        $exception = new BaseException(
            'AddressFormResquestError',
            'Encontramos erros nos dados informados.',
            'Verifique se todos os dados foram informados corretamente',
            DefaultException::GENERAL_SUPPORT_MESSAGE,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            $validator->errors()->getMessages()
        );

        throw new BuildExceptions($exception);
    }
}
