<?php

namespace App\Modules\Clientes\UseCases\ClienteContacto;

use App\Modules\Clientes\Entities\ClienteContactoEntity;
use App\Modules\Clientes\Repositories\ClienteContacto\ClienteContactoRepositoryAbstract;

class BuscarContactoPorIdUseCase
{
    public function __construct(
        private readonly ClienteContactoRepositoryAbstract $repo
    ) {}

    public function execute(int $id): ClienteContactoEntity|null
    {
        return $this->repo->findById($id);
    }
}
