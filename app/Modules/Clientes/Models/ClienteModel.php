<?php

namespace App\Modules\Clientes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClienteModel extends Model
{
    // Tabla asociada
    protected $table = 'clientes';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombres',
        'apellidos',
        'empresa',
        'celular',
        'password',
        'edad',
        'email',
        'sexo',
        'medio_ingreso',
        'registro',
        'estado',
        'tipo_documento',
        'numero_documento',
        'antiguo',
        'puntuacion',
    ];

    // Ocultar campos sensibles al convertir a JSON
    protected $hidden = [
        'password',
    ];

    // Tipos de los campos
    protected $casts = [
        'edad' => 'integer',
        'estado' => 'integer',
        'antiguo' => 'integer',
        'puntuacion' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    // Relaciones
    public function contactos(): HasMany
    {
        return $this->hasMany(ClienteContactoModel::class, 'cliente_id');
    }

    // Si solo hay una ubicación por cliente
    public function ubicacion(): HasOne
    {
        return $this->hasOne(ClienteUbicacionModel::class, 'cliente_id');
    }
}
