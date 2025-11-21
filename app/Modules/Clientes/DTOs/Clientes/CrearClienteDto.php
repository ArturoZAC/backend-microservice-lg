<?php

namespace App\Modules\Clientes\DTOs\Clientes;

class CrearClienteDTO
{
    public function __construct(
        public readonly string $nombres,
        public readonly string $apellidos,
        public readonly string $empresa,
        public readonly string $celular,
        public readonly string $password,
        public readonly int    $edad,
        public readonly string $email,
        public readonly string $sexo,
        public readonly string $medio_ingreso,
        public readonly string $registro,
        public readonly int    $estado,
        public readonly string $tipo_documento,
        public readonly string $numero_documento,
        public readonly int    $antiguo,
        public readonly int    $puntuacion,
    ) {}

    // MÉTODO FACTORY Estilo Zod: [error, dto]
    public static function create(array $data): array
    {
        // 1. Lista de campos requeridos
        $required = [
            'nombres', 'apellidos', 'empresa', 'celular',
            'password', 'edad', 'email', 'sexo',
            'medio_ingreso', 'registro', 'estado',
            'tipo_documento', 'numero_documento',
            'antiguo', 'puntuacion'
        ];

        foreach ($required as $field) {
            if (!array_key_exists($field, $data)) {
                return ["Falta el campo requerido: $field", null];
            }
        }

        // 2. Validación enums tipo Zod
        $medioIngresoEnum = ['facebook','whatsapp','google','instagram','post_venta','recomendacion','logos'];
        if (!in_array($data['medio_ingreso'], $medioIngresoEnum, true)) {
            return ["Valor inválido para medio_ingreso", null];
        }

        $registroEnum = ['sistema','pagina_web'];
        if (!in_array($data['registro'], $registroEnum, true)) {
            return ["Valor inválido para registro", null];
        }

        $tipoDocumentoEnum = ['dni','ruc','dni_extranjeria'];
        if (!in_array($data['tipo_documento'], $tipoDocumentoEnum, true)) {
            return ["Valor inválido para tipo_documento", null];
        }

        if ($data['puntuacion'] < 1 || $data['puntuacion'] > 10) {
            return ["La puntuación debe ser entre 1 y 10", null];
        }

        // 3. Crear instancia del DTO → estilo Zod
        $dto = new self(
            nombres:          (string)$data['nombres'],
            apellidos:        (string)$data['apellidos'],
            empresa:          (string)$data['empresa'],
            celular:          (string)$data['celular'],
            password:         (string)$data['password'],
            edad:             (int)$data['edad'],
            email:            (string)$data['email'],
            sexo:             (string)$data['sexo'],
            medio_ingreso:    (string)$data['medio_ingreso'],
            registro:         (string)$data['registro'],
            estado:           (int)$data['estado'],
            tipo_documento:   (string)$data['tipo_documento'],
            numero_documento: (string)$data['numero_documento'],
            antiguo:          (int)$data['antiguo'],
            puntuacion:       (int)$data['puntuacion'],
        );

        // RETORNA EXACTAMENTE COMO ZOD:
        // [ errorMessage, null ]  OR [ null, dto ]
        return [null, $dto];
    }
}
