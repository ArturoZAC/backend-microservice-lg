<?php

namespace App\Modules\Clientes\UseCases\ClienteContacto;

use App\Modules\Clientes\Entities\ClienteContactoEntity;
use App\Modules\Clientes\DTOs\ClientesContacto\CrearClienteContactoDTO;
use App\Modules\Clientes\Repositories\ClienteContacto\ClienteContactoRepositoryAbstract;

class CrearClienteContactoUseCase
{
    public function __construct(
        private readonly ClienteContactoRepositoryAbstract $repositorio
    ) {}

    public function execute(int $clienteId, CrearClienteContactoDTO $dto): ClienteContactoEntity
    {
        return $this->repositorio->create($clienteId, $dto);
    }
}