<?php

namespace App\Modules\Clientes\UseCases\ClienteUbicacion;

use App\Modules\Clientes\Repositories\ClienteUbicacion\ClienteUbicacionRepositoryAbstract;

class EliminarUbicacionUseCase
{
    public function __construct(private readonly ClienteUbicacionRepositoryAbstract $repository) {}

    public function execute(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
