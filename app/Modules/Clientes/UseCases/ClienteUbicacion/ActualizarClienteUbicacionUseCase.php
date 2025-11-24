<?php

namespace App\Modules\Clientes\UseCases\ClienteUbicacion;

use App\Modules\Clientes\Repositories\ClienteUbicacion\ClienteUbicacionRepositoryAbstract;
use App\Modules\Clientes\DTOs\ClientesUbicacion\ActualizarClienteUbicacionDTO;
use App\Modules\Clientes\Entities\ClienteUbicacionEntity;

class ActualizarClienteUbicacionUseCase
{
    public function __construct(private readonly ClienteUbicacionRepositoryAbstract $repository) {}

    public function execute(ActualizarClienteUbicacionDTO $dto): ?ClienteUbicacionEntity
    {
        return $this->repository->update($dto);
    }
}
