<?php

namespace App\Controllers;

use App\Models\TareaModel;
use CodeIgniter\Controller;
use App\Models\ProyectoModel; 


class TareaController extends Controller
{
    // Muestra la lista de tareas
    public function index()
    {
        $tareaModel = new TareaModel();
        $query = $this->request->getGet('query');
        
        // Obtener las tareas basadas en el término de búsqueda si existe
        $tareas = $query
            ? $tareaModel->like('NO_TAREA', $query)
                         ->orLike('NOMBRE_TAREA', $query)
                         ->orLike('LIDER', $query)
                         ->findAll()
            : $tareaModel->findAll();
    
        return view('tareas/lista', [
            'tareas' => $tareas,
            'query' => $query
        ]);
    }

    public function create()
    {
        return view('tareas/crear');
    }

    // Guarda una nueva tarea en la base de datos.
    public function store()
    {
        $tareaModel = new TareaModel();

        $data = [
            'NO_TAREA' => $this->request->getPost('no_tarea'),
            'NOMBRE_TAREA' => $this->request->getPost('nombre_tarea'),
            'DESCRIPCION' => $this->request->getPost('descripcion'),
            'LIDER' => $this->request->getPost('lider'),
            'FECHA_FIN' => $this->request->getPost('fecha_fin'),
            'FECHA_INICIO' => $this->request->getPost('fecha_inicio'),
            'PRIORIDAD' => $this->request->getPost('prioridad'),
            'ESTADO_TAREA' => $this->request->getPost('estado_tarea'),
            'FECHA_CREACION' => date('Y-m-d H:i:s'),  // Asignar fecha de creación
            'ID_PROYECTO' => $this->request->getPost('id_proyecto'),
        ];

        if ($tareaModel->insertTarea($data)) {
            return redirect()->to('/tareas')->with('success', 'Tarea creada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar la tarea.');
        }
    }

    // Muestra una tarea específica
    public function show($id)
    {
        $tareaModel = new TareaModel();
        $tarea = $tareaModel->find($id);

        if (!$tarea) {
            return redirect()->to('/tareas')->with('error', 'Tarea no encontrada.');
        }

        return view('tareas/ver', ['tarea' => $tarea]);
    }

    // Muestra el formulario para editar una tarea
    // Muestra el formulario para editar una tarea
    public function edit($id)
    {
        $tareaModel = new TareaModel();
        $proyectoModel = new ProyectoModel(); // Instancia del modelo de Proyecto

        $tarea = $tareaModel->find($id);
        
        // Verificar si la tarea existe
        if (!$tarea) {
            return redirect()->to('/tareas')->with('error', 'Tarea no encontrada.');
        }

        // Obtener la lista de proyectos
        $proyectos = $proyectoModel->findAll();

        // Pasar tanto la tarea como los proyectos a la vista
        return view('tareas/editar', [
            'tarea' => $tarea,
            'proyectos' => $proyectos // Aquí se pasa la variable proyectos a la vista
        ]);
    }

    // Actualiza los datos de una tarea existente
    public function update($id)
    {
        $tareaModel = new TareaModel();

        $data = [
            'NO_TAREA' => $this->request->getPost('no_tarea'),
            'NOMBRE_TAREA' => $this->request->getPost('nombre_tarea'),
            'DESCRIPCION' => $this->request->getPost('descripcion'),
            'LIDER' => $this->request->getPost('lider'),
            'FECHA_FIN' => $this->request->getPost('fecha_fin'),
            'FECHA_INICIO' => $this->request->getPost('fecha_inicio'),
            'PRIORIDAD' => $this->request->getPost('prioridad'),
            'ESTADO_TAREA' => $this->request->getPost('estado_tarea'),
            'ACTUALIZADO_POR' => $this->request->getPost('actualizado_por'),
            'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),  // Asignar fecha de actualización
            'ID_PROYECTO' => $this->request->getPost('id_proyecto'),
        ];

        if ($tareaModel->update($id, $data)) {
            return redirect()->to('/tareas')->with('success', 'Tarea actualizada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar la tarea.');
        }
    }

    // Elimina las tareas seleccionadas
    public function eliminar()
    {
        $tareasIds = $this->request->getPost('tareas');
        
        if (!empty($tareasIds)) {
            $tareaModel = new TareaModel();
            $tareaModel->whereIn('ID_TAREA', $tareasIds)->delete();
            return redirect()->to('/tareas')->with('success', 'Tareas eliminadas correctamente.');
        } else {
            return redirect()->to('/tareas')->with('error', 'No se seleccionó ninguna tarea.');
        }
    }

    // Exporta las tareas a un archivo CSV
    public function exportarCSV()
    {
        $tareaModel = new TareaModel();
        $tareasIds = $this->request->getPost('tareas');

        if (empty($tareasIds)) {
            return redirect()->back()->with('error', 'No se seleccionó ninguna tarea.');
        }

        $tareas = $tareaModel->whereIn('ID_TAREA', $tareasIds)->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="tareas_seleccionadas.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID_TAREA', 'NO_TAREA', 'NOMBRE_TAREA', 'DESCRIPCION', 'LIDER', 'FECHA_FIN', 'FECHA_INICIO', 'PRIORIDAD', 'ESTADO_TAREA', 'ID_PROYECTO']);

        foreach ($tareas as $tarea) {
            fputcsv($output, [
                $tarea['ID_TAREA'],
                $tarea['NO_TAREA'],
                $tarea['NOMBRE_TAREA'],
                $tarea['DESCRIPCION'],
                $tarea['LIDER'],
                $tarea['FECHA_FIN'],
                $tarea['FECHA_INICIO'],
                $tarea['PRIORIDAD'],
                $tarea['ESTADO_TAREA'],
                $tarea['ID_PROYECTO']
            ]);
        }

        fclose($output);
        exit;
    }
}
