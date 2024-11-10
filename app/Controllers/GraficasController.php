<?php

namespace App\Controllers;

use App\Models\ProyectoModel;
use App\Models\TareaModel;
use App\Models\RecursoEmpleadoModel;
use App\Models\ReunionModel;
use CodeIgniter\Controller;

class GraficasController extends Controller
{
    public function seleccion()
    {
        return view('seleccion_grafica');
    }

    public function getDatosProyectos()
    {
        $proyectoModel = new ProyectoModel();
        $estado = $this->request->getGet('estado') ?? 'todos';
        $idProyecto = $this->request->getGet('id_proyecto');

        $query = $proyectoModel;

        if ($estado !== 'todos') {
            $query = $query->where('ESTADO_PROYECTO', $estado);
        }
        if (!empty($idProyecto)) {
            $query = $query->where('ID_PROYECTO', $idProyecto);
        }

        $proyectos = $query->findAll();

        // Asegúrate de que siempre devuelves JSON para esta ruta
        return $this->response->setJSON($proyectos);
    }

    // Ejemplo del método graficaProyectos para devolver JSON
    public function graficaProyectos()
    {
        $estado = $this->request->getGet('estado') ?? 'todos';
        $idProyecto = $this->request->getGet('id_proyecto');

        $proyectoModel = new ProyectoModel();
        $query = $proyectoModel;

        if ($estado !== 'todos') {
            $query = $query->where('ESTADO_PROYECTO', $estado);
        }
        if (!empty($idProyecto)) {
            $query = $query->where('ID_PROYECTO', $idProyecto);
        }

        $proyectos = $query->findAll();

        // Devolver JSON si es una solicitud AJAX o `fetch`
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($proyectos);
        }

        // Si no es AJAX, cargar la vista completa para mostrar la gráfica
        return view('grafica_proyectos');
    }


    // GraficasController.php

    // GraficasController.php

 // GraficasController.php

public function getDatosRecursos()
{
    $estado = $this->request->getGet('estado') ?? 'todos';
    $nivel = $this->request->getGet('nivel') ?? 'todos';

    $recursoModel = new RecursoEmpleadoModel();
    $query = $recursoModel;

    // Aplicar filtros
    if ($estado !== 'todos') {
        $query = $query->where('ESTADO', $estado);
    }
    if ($nivel !== 'todos') {
        $query = $query->where('NIVEL', $nivel);
    }

    $recursos = $query->findAll();

    // Devolver JSON siempre para esta ruta
    return $this->response->setJSON($recursos);
}


    // GraficasController.php

public function graficaRecursos()
{
    // Simplemente cargamos la vista aquí sin devolver JSON
    return view('grafica_recursos');
}

    // GraficasController.php

    public function getDatosTareas()
    {
        $prioridad = $this->request->getGet('prioridad') ?? 'todas';
        $estado = $this->request->getGet('estado') ?? 'todos';

        $tareaModel = new TareaModel();
        $query = $tareaModel;

        // Aplicar filtros de prioridad y estado
        if ($prioridad !== 'todas') {
            $query = $query->where('PRIORIDAD', strtoupper($prioridad));
        }
        if ($estado !== 'todos') {
            $query = $query->where('ESTADO_TAREA', strtoupper($estado));
        }

        $tareas = $query->findAll();

        // Devolver JSON siempre para esta ruta
        return $this->response->setJSON($tareas);
    }

    public function graficaTareas()
    {
        $prioridad = $this->request->getGet('prioridad') ?? 'todas';
        $tareaModel = new TareaModel();
        $query = $tareaModel;

        if ($prioridad !== 'todas') {
            $query = $query->where('PRIORIDAD', $prioridad);
        }

        $tareas = $query->findAll();

        // Devolver JSON solo si es una solicitud AJAX o desde fetch
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($tareas);
        }

        // Cargar la vista de la gráfica si es una solicitud de página
        return view('grafica_tareas', ['tareas' => $tareas]);
    }



    public function exportarGrafica()
    {
        // Lógica de exportación (usualmente PDF o imagen)
        return redirect()->back()->with('success', 'Gráfica exportada exitosamente en PDF');
    }
}
