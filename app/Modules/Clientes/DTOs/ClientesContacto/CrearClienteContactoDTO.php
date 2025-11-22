<?php

namespace App\Modules\Clientes\DTOs\ClientesContacto;

class CrearClienteContactoDTO
{
    public function __construct(
        public readonly string $nombres,
        public readonly string $celular,
        public readonly string $correo,
        public readonly string $tipo_documento,
        public readonly string $numero_documento,
    ) {}

    public static function create(array $data): array
    {
        $required = ['nombres', 'celular', 'correo', 'tipo_documento', 'numero_documento'];

        foreach ($required as $field) {
            if (!array_key_exists($field, $data)) {
                return ["Falta el campo requerido: $field", null];
            }
        }

        $tipoDocumentoEnum = ['dni','ruc','dni_extranjeria'];
        if (!in_array($data['tipo_documento'], $tipoDocumentoEnum, true)) {
            return ["Valor inválido para tipo_documento", null];
        }

        $dto = new self(
            nombres: $data['nombres'],
            celular: $data['celular'],
            correo: $data['correo'],
            tipo_documento: $data['tipo_documento'],
            numero_documento: $data['numero_documento']
        );

        return [null, $dto];
    }
}