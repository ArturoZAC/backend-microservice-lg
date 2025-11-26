<?php

namespace App\Modules\Clientes\DTOs\Clientes;

class CrearClienteDTO
{
    public function __construct(
        // Obligatorios
        public readonly string $nombres,
        public readonly string $apellidos,
        public readonly string $email,
        public readonly string $tipo_documento,
        public readonly string $numero_documento,

        // Opcionales
        public readonly ?string $empresa = null,
        public readonly ?string $celular = null,
        public readonly ?string $password = null,
        public readonly ?int $edad = null,
        public readonly ?string $sexo = null,
        public readonly ?string $medio_ingreso = null,

        // Automáticos / Default
        public readonly string $registro = "sistema",
        public readonly int $estado = 1,
        public readonly int $antiguo = 1,
        public readonly int $puntuacion = 0,
    ) {}

    // Método factory estilo Zod
    public static function create(array $data): array
    {
        // 1. Campos obligatorios
        $required = [
            'nombres',
            'apellidos',
            'email',
            'tipo_documento',
            'numero_documento'
        ];

        foreach ($required as $field) {
            if (!array_key_exists($field, $data) || $data[$field] === '') {
                return ["Falta el campo requerido: $field", null];
            }
        }

        // 2. Validación ENUMS
        $sexoEnum = ['masculino','femenino','otro'];
        if (isset($data['sexo']) && !in_array($data['sexo'], $sexoEnum, true)) {
            return ["Valor inválido para sexo", null];
        }

        $medioIngresoEnum = ['facebook','whatsapp','google','instagram','post_venta','recomendacion','logos'];
        if (isset($data['medio_ingreso']) && !in_array($data['medio_ingreso'], $medioIngresoEnum, true)) {
            return ["Valor inválido para medio_ingreso", null];
        }

        $tipoDocumentoEnum = ['dni','ruc','dni_extranjeria'];
        if (!in_array($data['tipo_documento'], $tipoDocumentoEnum, true)) {
            return ["Valor inválido para tipo_documento", null];
        }

        // 3. Crear instancia DTO
        $dto = new self(
            nombres: $data['nombres'],
            apellidos: $data['apellidos'],
            email: $data['email'],
            tipo_documento: $data['tipo_documento'],
            numero_documento: $data['numero_documento'],

            empresa: $data['empresa'] ?? null,
            celular: $data['celular'] ?? null,
            password: $data['password'] ?? null,
            edad: isset($data['edad']) ? (int)$data['edad'] : null,
            sexo: $data['sexo'] ?? null,
            medio_ingreso: $data['medio_ingreso'] ?? null,
        );

        return [null, $dto];
    }
}
