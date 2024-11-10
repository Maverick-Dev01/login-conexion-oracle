<?php

namespace App\Models;

use CodeIgniter\Model;

class RecursoEmpleadoModel extends Model
{
    protected $table = 'RECURSO_EMPLEADO';
    protected $primaryKey = 'ID_RECURSO_EMPLEADO';
    protected $allowedFields = [
        'NOMBRE',
        'APELLIDO_PATERNO',
        'APELLIDO_MATERNO',
        'NIVEL',
        'TIPO_EMPLEADO',
        'ESTADO',
        'FECHA_CONTRATACION',
        'ID_PUESTO',
        'ID_ESPECIALIDAD',
        'FECHA_CREACION',
        'CREADO_POR',
        'FECHA_ACTUALIZACION',
        'ACTUALIZADO_POR'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertRecursoEmpleado($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_R_EMPLEADO.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_RECURSO_EMPLEADO'] = $row->ID;
        return $this->insert($data);
    }
}
