<?php

namespace App\Modules\Clientes\DTOs\ClientesUbicacion;

class ActualizarClienteUbicacionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $latitud,
        public readonly ?string $longitud,
        public readonly ?string $pais,
        public readonly ?string $departamento,
        public readonly ?string $distrito
    ) {}

    public static function create(array $data): array
    {
        if (!isset($data['id'])) {
            return ["Falta el campo requerido: id", null];
        }

        $dto = new self(
            id: intval($data['id']),
            latitud: $data['latitud'] ?? null,
            longitud: $data['longitud'] ?? null,
            pais: $data['pais'] ?? null,
            departamento: $data['departamento'] ?? null,
            distrito: $data['distrito'] ?? null
        );

        return [null, $dto];
    }
}
