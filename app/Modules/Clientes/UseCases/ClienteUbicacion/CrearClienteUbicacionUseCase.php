<?php

namespace App\Modules\Clientes\UseCases\ClienteUbicacion;

use App\Modules\Clientes\Repositories\ClienteUbicacion\ClienteUbicacionRepositoryAbstract;
use App\Modules\Clientes\DTOs\ClientesUbicacion\CrearClienteUbicacionDTO;
use App\Modules\Clientes\Entities\ClienteUbicacionEntity;

class CrearClienteUbicacionUseCase
{
    public function __construct(private readonly ClienteUbicacionRepositoryAbstract $repository) {}

    public function execute(int $clienteId, CrearClienteUbicacionDTO $dto): ClienteUbicacionEntity
    {
        return $this->repository->create($clienteId, $dto);
    }
}
