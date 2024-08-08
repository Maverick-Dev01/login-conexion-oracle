<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestController extends Controller
{
    public function index()
    {
        // Conectar a la base de datos
        $db = Database::connect(); // Establece la conexión a la base de datos

        // Ejecutar una consulta para obtener datos de la tabla 'usuario'
        $query = $db->query('SELECT * FROM usuario'); // Ejecuta la consulta SQL

        // Obtener los resultados
        $result = $query->getResult(); // Obtiene los resultados de la consulta en un array de objetos

        // Mostrar los resultados
        echo '<pre>'; // Inicia el formato predefinido
        print_r($result); // Imprime el array de resultados
        echo '</pre>'; // Cierra el formato predefinido
    }
}
