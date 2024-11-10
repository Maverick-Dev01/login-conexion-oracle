<?php

namespace App\Models;

use CodeIgniter\Model;

class ProyectoModel extends Model
{
    protected $table = 'PROYECTO';
    protected $primaryKey = 'ID_PROYECTO';
    protected $allowedFields = [
        'NO_PROYECTO',
        'NOMBRE_PROYECTO',
        'AREA',
        'TIPO',
        'DETALLES',
        'PRESUPUESTO',
        'PRIORIDAD',
        'FECHA_INICIO_PLANEADO',
        'FECHA_FIN_PLANEADO',
        'FECHA_INICIO_REAL',
        'FECHA_FIN_REAL',
        'AVANCE_PLANEADO',
        'AVANCE_REAL',
        'DIAS_DESVIO',
        'FASE',
        'ESTADO_PROYECTO',
        'FECHA_CREACION',
        'ACTUALIZADO_POR',
        'FECHA_ACTUALIZACION',
        'ID_CLIENTE'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertProyecto($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_PROYECTO.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_PROYECTO'] = $row->ID;
        return $this->insert($data);
    }
}
