<?php

namespace App\Modules\Clientes\DTOs\Clientes;

class ActualizarClienteDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $nombres,
        public readonly ?string $apellidos,
        public readonly ?string $empresa,
        public readonly ?string $celular,
        public readonly ?string $password,
        public readonly ?int $edad,
        public readonly ?string $email,
        public readonly ?string $sexo,
        public readonly ?string $medio_ingreso,
        public readonly ?string $registro,
        public readonly ?int $estado,
        public readonly ?string $tipo_documento,
        public readonly ?string $numero_documento,
        public readonly ?int $antiguo,
        public readonly ?int $puntuacion,
    ) {}

    // CREATE estilo Zod: [error, dto]
    public static function create(array $data): array
    {
        if (!isset($data['id']) || intval($data['id']) <= 0) {
            return ['ID inválido', null];
        }

        // ENUMS opcionales
        $medioIngresoEnum = ['facebook','whatsapp','google','instagram','post_venta','recomendacion','logos'];
        if (isset($data['medio_ingreso']) && !in_array($data['medio_ingreso'], $medioIngresoEnum, true)) {
            return ["Valor inválido para medio_ingreso", null];
        }

        $registroEnum = ['sistema','pagina_web'];
        if (isset($data['registro']) && !in_array($data['registro'], $registroEnum, true)) {
            return ["Valor inválido para registro", null];
        }

        $tipoDocumentoEnum = ['dni','ruc','dni_extranjeria'];
        if (isset($data['tipo_documento']) && !in_array($data['tipo_documento'], $tipoDocumentoEnum, true)) {
            return ["Valor inválido para tipo_documento", null];
        }

        if (isset($data['puntuacion']) && ($data['puntuacion'] < 1 || $data['puntuacion'] > 10)) {
            return ["La puntuación debe ser entre 1 y 10", null];
        }

        $dto = new self(
            id: intval($data['id']),
            nombres: $data['nombres'] ?? null,
            apellidos: $data['apellidos'] ?? null,
            empresa: $data['empresa'] ?? null,
            celular: $data['celular'] ?? null,
            password: $data['password'] ?? null,
            edad: isset($data['edad']) ? intval($data['edad']) : null,
            email: $data['email'] ?? null,
            sexo: $data['sexo'] ?? null,
            medio_ingreso: $data['medio_ingreso'] ?? null,
            registro: $data['registro'] ?? null,
            estado: isset($data['estado']) ? intval($data['estado']) : null,
            tipo_documento: $data['tipo_documento'] ?? null,
            numero_documento: $data['numero_documento'] ?? null,
            antiguo: isset($data['antiguo']) ? intval($data['antiguo']) : null,
            puntuacion: isset($data['puntuacion']) ? intval($data['puntuacion']) : null,
        );

        return [null, $dto];
    }
}
