<?php

namespace App\Modules\Clientes\UseCases\ClienteContacto;

use App\Modules\Clientes\Repositories\ClienteContacto\ClienteContactoRepositoryAbstract;

class EliminarContactoPorIdUseCase
{
    public function __construct(
        private readonly ClienteContactoRepositoryAbstract $repo
    ) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
