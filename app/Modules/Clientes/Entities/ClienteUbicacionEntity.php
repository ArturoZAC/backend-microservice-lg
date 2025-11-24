<?php

namespace App\Modules\Clientes\Entities;

class ClienteUbicacionEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $cliente_id,
        public readonly string $latitud,
        public readonly string $longitud,
        public readonly string $pais,
        public readonly string $departamento,
        public readonly string $distrito,
    ) {}

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'cliente_id'  => $this->cliente_id,
            'latitud'     => $this->latitud,
            'longitud'    => $this->longitud,
            'pais'        => $this->pais,
            'departamento'=> $this->departamento,
            'distrito'    => $this->distrito,
        ];
    }
}
