<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    // Define la tabla asociada a este modelo (en mayúsculas)
    protected $table = 'USUARIO';
    
    // Define la clave primaria de la tabla (en mayúsculas)
    protected $primaryKey = 'ID_USUARIO';
    
    // Define los campos que se pueden insertar o actualizar en la base de datos (en mayúsculas)
    protected $allowedFields = [
        'NO_USUARIO',           // Número de usuario
        'NOMBRE',
        'APELLIDO_PATERNO',
        'APELLIDO_MATERNO',
        'TELEFONO',
        'EMAIL',
        'USUARIO',
        'CONTRASENIA',
        'ID_ROL',
        'FECHA_CREACION',
        'ACTUALIZADO_POR',
        'FECHA_ACTUALIZACION'
    ];

    // Define el tipo de retorno de los resultados de las consultas
    protected $returnType = 'array';
    
    // Indica si el modelo debe manejar automáticamente los timestamps (no se usa en este caso)
    protected $useTimestamps = false;

    /**
     * Inserta un nuevo usuario en la tabla USUARIO.
     * 
     * Este método utiliza una secuencia de base de datos (seq_id_usuario) 
     * para obtener un nuevo ID de usuario antes de insertar el registro.
     * 
     * @param array $data Los datos del usuario que se van a insertar.
     * @return bool true en caso de éxito, false en caso de error.
     */
    public function insertUsuario($data)
    {
        // Conecta a la base de datos
        $db = \Config\Database::connect();

        // Ejecuta una consulta para obtener el siguiente valor de la secuencia seq_id_usuario
        $query = $db->query("SELECT seq_id_usuario.NEXTVAL as ID FROM DUAL");
        $row = $query->getRow();
        
        // Asigna el nuevo ID de usuario al arreglo de datos (en mayúsculas)
        $data['ID_USUARIO'] = $row->ID;

        // Inserta los datos del usuario en la tabla USUARIO
        return $this->insert($data);
    }

    /**
     * Obtiene un usuario por su nombre de usuario.
     * 
     * Este método busca un usuario en la tabla USUARIO 
     * basado en el valor del campo USUARIO.
     * 
     * @param string $username El nombre de usuario que se desea buscar.
     * @return array|null Los datos del usuario si se encuentra, null si no.
     */
    public function getUsuarioByUsername($username)
    {
        // Realiza una consulta donde el campo USUARIO coincide con el nombre de usuario proporcionado
        return $this->where('USUARIO', $username)->first();
    }
}
