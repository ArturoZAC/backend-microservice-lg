<?php

namespace App\Modules\Clientes\UseCases\ClienteContacto;

use App\Modules\Clientes\Repositories\ClienteContacto\ClienteContactoRepositoryAbstract;
use App\Modules\Clientes\Entities\ClienteContactoEntity;

class ListaContactosUseCase
{
    public function __construct(
        private readonly ClienteContactoRepositoryAbstract $repo
    ) {}

    /**
     * @return ClienteContactoEntity[]
     */
    public function execute(int $clienteId): array
    {
        return $this->repo->getAll($clienteId);
    }
}
