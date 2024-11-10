<?php

namespace App\Controllers;

use App\Models\ProyectoModel;
use CodeIgniter\Controller;

class GraficasController extends Controller
{
    public function index()
    {
        // Cargar la vista de la gráfica
        return view('grafica_proyectos');
    }

    public function getDatosProyectos()
    {
        $proyectoModel = new ProyectoModel();
        
        // Obtén los datos de los proyectos que necesitas
        $proyectos = $proyectoModel->select('NOMBRE_PROYECTO, DIAS_DESVIO, AVANCE_PLANEADO, AVANCE_REAL')
                                   ->findAll();

        return $this->response->setJSON($proyectos);
    }
}
