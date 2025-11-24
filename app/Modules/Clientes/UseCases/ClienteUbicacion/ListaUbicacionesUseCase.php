<?php

namespace App\Modules\Clientes\UseCases\ClienteUbicacion;

use App\Modules\Clientes\Repositories\ClienteUbicacion\ClienteUbicacionRepositoryAbstract;

class ListaUbicacionesUseCase
{
    public function __construct(private readonly ClienteUbicacionRepositoryAbstract $repository) {}

    // /** @return ClienteUbicacionEntity[] */
    public function execute(int $clienteId): array
    {
        return $this->repository->getAll($clienteId);
    }
}
