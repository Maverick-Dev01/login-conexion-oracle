<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'ROL';
    protected $primaryKey = 'ID_ROL';
    protected $allowedFields = ['NOMBRE_ROL', 'DESCRIPCION', 'FECHA_CREACION', 'ACTUALIZADO_POR', 'FECHA_ACTUALIZACION'];
}
