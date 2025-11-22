<?php

namespace App\Modules\Clientes\UseCases\Cliente;

use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;
use App\Modules\Clientes\DTOs\Clientes\ActualizarClienteDTO;

class ActualizarClienteUseCase
{
    public function __construct(
        private readonly ClienteRepositoryAbstract $repository
    ) {}

    public function execute(ActualizarClienteDTO $dto)
    {
        $data = array_filter([
            'nombres' => $dto->nombres,
            'apellidos' => $dto->apellidos,
            'empresa' => $dto->empresa,
            'celular' => $dto->celular,
            'password' => $dto->password,
            'edad' => $dto->edad,
            'email' => $dto->email,
            'sexo' => $dto->sexo,
            'medio_ingreso' => $dto->medio_ingreso,
            'registro' => $dto->registro,
            'estado' => $dto->estado,
            'tipo_documento' => $dto->tipo_documento,
            'numero_documento' => $dto->numero_documento,
            'antiguo' => $dto->antiguo,
            'puntuacion' => $dto->puntuacion,
        ], fn($v) => !is_null($v));

        return $this->repository->update($dto->id, $data);
    }
}
