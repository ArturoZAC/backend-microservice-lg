<?php

namespace App\Modules\Clientes\UseCases\ClienteUbicacion;

use App\Modules\Clientes\Repositories\ClienteUbicacion\ClienteUbicacionRepositoryAbstract;

class BuscarUbicacionPorIdUseCase
{
    public function __construct(private readonly ClienteUbicacionRepositoryAbstract $repository) {}

    public function execute(int $id)
    {
        return $this->repository->findById($id);
    }
}
