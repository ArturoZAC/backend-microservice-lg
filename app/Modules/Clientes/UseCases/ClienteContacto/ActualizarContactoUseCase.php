<?php

namespace App\Modules\Clientes\UseCases\ClienteContacto;

use App\Modules\Clientes\DTOs\ClientesContacto\ActualizarContactoDTO;
use App\Modules\Clientes\Entities\ClienteContactoEntity;
use App\Modules\Clientes\Repositories\ClienteContacto\ClienteContactoRepositoryAbstract;

class ActualizarContactoUseCase
{
    public function __construct(
        private readonly ClienteContactoRepositoryAbstract $repo
    ) {}

    public function execute(ActualizarContactoDTO $dto): ?ClienteContactoEntity
    {
        // Simplemente pasamos el DTO completo
        return $this->repo->update($dto);
    }
}