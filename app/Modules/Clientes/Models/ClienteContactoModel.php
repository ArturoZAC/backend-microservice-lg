<?php
namespace App\Modules\Clientes\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteContactoModel extends Model
{
    protected $table = 'clientes_contactos';
    protected $fillable = [
        'cliente_id',
        'nombres',
        'celular',
        'correo',
        'tipo_documento',
        'numero_documento'
    ];
}
