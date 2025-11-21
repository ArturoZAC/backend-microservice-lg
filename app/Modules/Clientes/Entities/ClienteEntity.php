<?php

namespace App\Modules\Clientes\Entities;

class ClienteEntity
{
    public function __construct(
        public readonly int $id,
        public readonly string $nombres,
        public readonly string $apellidos,
        public readonly ?string $empresa,
        public readonly ?string $celular,
        public readonly ?string $password,
        public readonly ?int $edad,
        public readonly string $email,
        public readonly ?string $sexo,
        public readonly ?string $medioIngreso,
        public readonly string $registro,
        public readonly string $tipoDocumento,
        public readonly string $numeroDocumento,
        public readonly int $estado,
        public readonly int $antiguo,
        public readonly int $puntuacion
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'empresa' => $this->empresa,
            'celular' => $this->celular,
            'password' => $this->password,
            'edad' => $this->edad,
            'email' => $this->email,
            'sexo' => $this->sexo,
            'medio_ingreso' => $this->medioIngreso,
            'registro' => $this->registro,
            'tipo_documento' => $this->tipoDocumento,
            'numero_documento' => $this->numeroDocumento,
            'estado' => $this->estado,
            'antiguo' => $this->antiguo,
            'puntuacion' => $this->puntuacion,
        ];
    }
}
