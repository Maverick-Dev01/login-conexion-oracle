<?php

namespace App\Controllers;

use App\Models\ReunionModel;
use CodeIgniter\Controller;
use App\Models\ProyectoModel; 

class ReunionController extends Controller
{
    public function index()
    {
        $reunionModel = new ReunionModel();
        $query = $this->request->getGet('query');
        
        // Obtener las reuniones basadas en el término de búsqueda si existe
        if ($query) {
            $reunionModel->groupStart()
                ->like('NO_REUNION', $query)
                ->orLike('NOMBRE_REUNION', $query)
                ->orLike('AREA', $query)
                ->groupEnd();
            $reuniones = $reunionModel->findAll();
        } else {
            $reuniones = $reunionModel->findAll();
        }
    
        return view('reuniones/lista', [
            'reuniones' => $reuniones,
            'query' => $query
        ]);
    }
    

    public function create()
    {
        return view('reuniones/crear');
    }

    // Guarda una nueva reunión en la base de datos.
    public function store()
    {
        $reunionModel = new ReunionModel();

        $data = [
            'NO_REUNION' => $this->request->getPost('no_reunion'),
            'NOMBRE_REUNION' => $this->request->getPost('nombre_reunion'),
            'DETALLES' => $this->request->getPost('detalles'),
            'FECHA_COMIENZO' => $this->request->getPost('fecha_comienzo'),
            'HORA_COMIENZO' => $this->request->getPost('hora_comienzo'),
            'AREA' => $this->request->getPost('area'),
            'PLATAFORMA' => $this->request->getPost('plataforma'),
            'LINK' => $this->request->getPost('link'),
            'ESTATUS_REUNION' => $this->request->getPost('estatus_reunion'),
            'FECHA_CREACION' => date('Y-m-d H:i:s'),  // Asignar fecha de creación
            'ID_PROYECTO' => $this->request->getPost('id_proyecto'),
        ];

        if ($reunionModel->insertReunion($data)) {
            return redirect()->to('/reuniones')->with('success', 'Reunión creada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar la reunión.');
        }
    }

    // Muestra una reunión específica
    public function show($id)
    {
        $reunionModel = new ReunionModel();
        $reunion = $reunionModel->find($id);

        if (!$reunion) {
            return redirect()->to('/reuniones')->with('error', 'Reunión no encontrada.');
        }

        return view('reuniones/ver', ['reunion' => $reunion]);
    }

    // Muestra el formulario para editar una reunión
    public function edit($id)
    {
        $reunionModel = new ReunionModel();
        $reunion = $reunionModel->find($id);

        if (!$reunion) {
            return redirect()->to('/reuniones')->with('error', 'Reunión no encontrada.');
        }

        return view('reuniones/editar', ['reunion' => $reunion]);
    }

    // Actualiza los datos de una reunión existente
    public function update($id)
    {
        $reunionModel = new ReunionModel();

        $data = [
            'NO_REUNION' => $this->request->getPost('no_reunion'),
            'NOMBRE_REUNION' => $this->request->getPost('nombre_reunion'),
            'DETALLES' => $this->request->getPost('detalles'),
            'FECHA_COMIENZO' => $this->request->getPost('fecha_comienzo'),
            'HORA_COMIENZO' => $this->request->getPost('hora_comienzo'),
            'AREA' => $this->request->getPost('area'),
            'PLATAFORMA' => $this->request->getPost('plataforma'),
            'LINK' => $this->request->getPost('link'),
            'ESTATUS_REUNION' => $this->request->getPost('estatus_reunion'),
            'ACTUALIZADO_POR' => $this->request->getPost('actualizado_por'),
            'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),  // Asignar fecha de actualización
            'ID_PROYECTO' => $this->request->getPost('id_proyecto'),
        ];

        if ($reunionModel->update($id, $data)) {
            return redirect()->to('/reuniones')->with('success', 'Reunión actualizada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar la reunión.');
        }
    }

    // Elimina las reuniones seleccionadas
    public function eliminar()
    {
        $reunionesIds = $this->request->getPost('reuniones');
        
        if (!empty($reunionesIds)) {
            $reunionModel = new ReunionModel();
            $reunionModel->whereIn('ID_REUNION', $reunionesIds)->delete();
            return redirect()->to('/reuniones')->with('success', 'Reuniones eliminadas correctamente.');
        } else {
            return redirect()->to('/reuniones')->with('error', 'No se seleccionó ninguna reunión.');
        }
    }

    // Exporta las reuniones a un archivo CSV
    public function exportarCSV()
    {
        $reunionModel = new ReunionModel();
        $reunionesIds = $this->request->getPost('reuniones');

        if (empty($reunionesIds)) {
            return redirect()->back()->with('error', 'No se seleccionó ninguna reunión.');
        }

        $reuniones = $reunionModel->whereIn('ID_REUNION', $reunionesIds)->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="reuniones_seleccionadas.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID_REUNION', 'NO_REUNION', 'NOMBRE_REUNION', 'DETALLES', 'FECHA_COMIENZO', 'HORA_COMIENZO', 'AREA', 'PLATAFORMA', 'LINK', 'ESTATUS_REUNION', 'ID_PROYECTO']);

        foreach ($reuniones as $reunion) {
            fputcsv($output, [
                $reunion['ID_REUNION'],
                $reunion['NO_REUNION'],
                $reunion['NOMBRE_REUNION'],
                $reunion['DETALLES'],
                $reunion['FECHA_COMIENZO'],
                $reunion['HORA_COMIENZO'],
                $reunion['AREA'],
                $reunion['PLATAFORMA'],
                $reunion['LINK'],
                $reunion['ESTATUS_REUNION'],
                $reunion['ID_PROYECTO']
            ]);
        }

        fclose($output);
        exit;
    }
}
