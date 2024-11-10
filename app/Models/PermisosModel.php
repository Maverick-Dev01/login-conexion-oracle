<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisosModel extends Model
{
    protected $table = 'PERMISOS';
    protected $primaryKey = 'ID_PERMISO';
    protected $allowedFields = ['NOMBRE_PERMISO'];

    /**
     * Inserta un nuevo permiso en la tabla PERMISOS.
     * Utiliza la secuencia SEQ_ID_PERMISO para generar un ID único.
     *
     * @param array $data Datos del permiso a insertar (nombre del permiso).
     * @return bool true en caso de éxito, false en caso de error.
     */
    public function insertPermiso($data)
    {
        // Conecta a la base de datos
        $db = \Config\Database::connect();

        // Obtén el siguiente valor de la secuencia para el ID_PERMISO
        $query = $db->query("SELECT SEQ_ID_PERMISO.NEXTVAL as ID_PERMISO FROM DUAL");
        $row = $query->getRow();

        // Asigna el ID_PERMISO generado al arreglo de datos
        $data['ID_PERMISO'] = $row->ID_PERMISO;

        // Inserta los datos del permiso en la tabla PERMISOS
        return $this->insert($data);
    }

    /**
     * Obtiene todos los permisos.
     * 
     * @return array Lista de todos los permisos.
     */
    public function getPermisos()
    {
        return $this->findAll();
    }
}
