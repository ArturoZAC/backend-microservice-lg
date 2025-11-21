<?php

return [
    App\Providers\AppServiceProvider::class,

    //agrega tu provider de Clientes
    App\Modules\Clientes\Providers\ClienteServiceProvider::class,
];
