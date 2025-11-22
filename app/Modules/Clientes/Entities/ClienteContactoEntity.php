<?php

namespace App\Modules\Clientes\Entities;

class ClienteContactoEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $cliente_id,
        public readonly string $nombres,
        public readonly string $celular,
        public readonly string $correo,
        public readonly string $tipo_documento,
        public readonly string $numero_documento,
    ) {}

    public function toArray(): array
    {
        return [
            'id'                => $this->id,
            'cliente_id'        => $this->cliente_id,
            'nombres'           => $this->nombres,
            'celular'           => $this->celular,
            'correo'            => $this->correo,
            'tipo_documento'    => $this->tipo_documento,
            'numero_documento'  => $this->numero_documento,
        ];
    }
}
