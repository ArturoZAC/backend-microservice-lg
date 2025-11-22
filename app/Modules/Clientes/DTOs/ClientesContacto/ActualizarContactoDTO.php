<?php

namespace App\Modules\Clientes\DTOs\ClientesContacto;

class ActualizarContactoDTO
{
    public function __construct(
        public readonly int $id,  
        public readonly ?string $nombres,
        public readonly ?string $celular,
        public readonly ?string $correo,
        public readonly ?string $tipo_documento,
        public readonly ?string $numero_documento
    ) {}

    public static function create(array $data): array
    {
        if (!isset($data['id'])) {
            return ["Falta el campo requerido: id", null];
        }

        // Validar solo si vienen los campos
        if (isset($data['tipo_documento'])) {
            $tipoDocumentoEnum = ['dni','ruc','dni_extranjeria'];
            if (!in_array($data['tipo_documento'], $tipoDocumentoEnum, true)) {
                return ["Valor inválido para tipo_documento", null];
            }
        }

        if (isset($data['correo']) && !filter_var($data['correo'], FILTER_VALIDATE_EMAIL)) {
            return ["Correo inválido", null];
        }

        $dto = new self(
            id: intval($data['id']),
            nombres: $data['nombres'] ?? null,
            celular: $data['celular'] ?? null,
            correo: $data['correo'] ?? null,
            tipo_documento: $data['tipo_documento'] ?? null,
            numero_documento: $data['numero_documento'] ?? null
        );

        return [null, $dto];
    }
}
