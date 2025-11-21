<?php

namespace App\Modules\Clientes\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteUbicacionModel extends Model
{
    protected $table = 'clientes_ubicacion';
    protected $fillable = [
        'cliente_id',
        'latitud',
        'longitud',
        'pais',
        'departamento',
        'distrito'
    ];
}
