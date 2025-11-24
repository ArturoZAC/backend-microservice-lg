<?php

namespace App\Modules\Clientes\DTOs\ClientesUbicacion;

class CrearClienteUbicacionDTO
{
    public function __construct(
        public readonly string $latitud,
        public readonly string $longitud,
        public readonly string $pais,
        public readonly string $departamento,
        public readonly string $distrito
    ) {}

    public static function create(array $data): array
    {
        $required = ['latitud', 'longitud', 'pais', 'departamento', 'distrito'];

        foreach ($required as $field) {
            if (!array_key_exists($field, $data)) {
                return ["Falta el campo requerido: $field", null];
            }
        }

        $dto = new self(
            latitud: $data['latitud'],
            longitud: $data['longitud'],
            pais: $data['pais'],
            departamento: $data['departamento'],
            distrito: $data['distrito']
        );

        return [null, $dto];
    }
}
