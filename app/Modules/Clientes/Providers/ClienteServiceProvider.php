<?php

namespace App\Modules\Clientes\Providers;
use Illuminate\Support\ServiceProvider;
use App\Modules\Clientes\Repositories\ClienteUbicacion\ClienteUbicacionRepositoryAbstract;
use App\Modules\Clientes\Repositories\ClienteUbicacion\EloquentClienteUbicacionRepository;

use App\Modules\Clientes\Repositories\ClienteContacto\ClienteContactoRepositoryAbstract;
use App\Modules\Clientes\Repositories\ClienteContacto\EloquentClienteContactoRepository;

use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;
use App\Modules\Clientes\Repositories\Cliente\EloquentClienteRepository;


//*INYECCION DE DEPENDENCIAS
class ClienteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Cliente
        $this->app->bind(
            ClienteRepositoryAbstract::class,
            EloquentClienteRepository::class
        );

        // ClienteContacto
        $this->app->bind(
            ClienteContactoRepositoryAbstract::class,
            EloquentClienteContactoRepository::class
        );

        // ClienteUbicacion
        $this->app->bind(
            ClienteUbicacionRepositoryAbstract::class,
            EloquentClienteUbicacionRepository::class
        );
    }
}
