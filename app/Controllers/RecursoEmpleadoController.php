<?php

namespace App\Controllers;

use App\Models\RecursoEmpleadoModel;
use CodeIgniter\Controller;

class RecursoEmpleadoController extends Controller
{
    // Muestra la lista de recursos empleados
    public function index()
    {
        $recursoEmpleadoModel = new RecursoEmpleadoModel();
        $query = $this->request->getGet('query');
        
        // Obtener los recursos empleados basados en el término de búsqueda si existe
        $recursosEmpleados = $query
            ? $recursoEmpleadoModel->like('NOMBRE', $query)
                                   ->orLike('APELLIDO_PATERNO', $query)
                                   ->orLike('APELLIDO_MATERNO', $query)
                                   ->findAll()
            : $recursoEmpleadoModel->findAll();
    
        return view('recursos_empleados/lista', [
            'recursosEmpleados' => $recursosEmpleados,
            'query' => $query
        ]);
    }

    public function create()
    {
        return view('recursos_empleados/crear');
    }

    // Guarda un nuevo recurso empleado en la base de datos.
    public function store()
    {
        $recursoEmpleadoModel = new RecursoEmpleadoModel();

        $data = [
            'NOMBRE' => $this->request->getPost('nombre'),
            'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
            'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
            'NIVEL' => $this->request->getPost('nivel'),
            'TIPO_EMPLEADO' => $this->request->getPost('tipo_empleado'),
            'ESTADO' => $this->request->getPost('estado'),
            'FECHA_CONTRATACION' => $this->request->getPost('fecha_contratacion'),
            'ID_PUESTO' => $this->request->getPost('id_puesto'),
            'ID_ESPECIALIDAD' => $this->request->getPost('id_especialidad'),
            'FECHA_CREACION' => date('Y-m-d H:i:s'),  // Asignar fecha de creación
            'CREADO_POR' => $this->request->getPost('creado_por'),
        ];

        if ($recursoEmpleadoModel->insertRecursoEmpleado($data)) {
            return redirect()->to('/recursos_empleados')->with('success', 'Recurso empleado creado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar el recurso empleado.');
        }
    }

    // Muestra un recurso empleado específico
    public function show($id)
    {
        $recursoEmpleadoModel = new RecursoEmpleadoModel();
        $recursoEmpleado = $recursoEmpleadoModel->find($id);

        if (!$recursoEmpleado) {
            return redirect()->to('/recursos_empleados')->with('error', 'Recurso empleado no encontrado.');
        }

        return view('recursos_empleados/ver', ['recursoEmpleado' => $recursoEmpleado]);
    }

    // Muestra el formulario para editar un recurso empleado
    public function edit($id)
    {
        $recursoEmpleadoModel = new RecursoEmpleadoModel();
        $recursoEmpleado = $recursoEmpleadoModel->find($id);

        if (!$recursoEmpleado) {
            return redirect()->to('/recursos_empleados')->with('error', 'Recurso empleado no encontrado.');
        }

        return view('recursos_empleados/editar', ['recursoEmpleado' => $recursoEmpleado]);
    }

    // Actualiza los datos de un recurso empleado existente
    public function update($id)
    {
        $recursoEmpleadoModel = new RecursoEmpleadoModel();

        $data = [
            'NOMBRE' => $this->request->getPost('nombre'),
            'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
            'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
            'NIVEL' => $this->request->getPost('nivel'),
            'TIPO_EMPLEADO' => $this->request->getPost('tipo_empleado'),
            'ESTADO' => $this->request->getPost('estado'),
            'FECHA_CONTRATACION' => $this->request->getPost('fecha_contratacion'),
            'ID_PUESTO' => $this->request->getPost('id_puesto'),
            'ID_ESPECIALIDAD' => $this->request->getPost('id_especialidad'),
            'ACTUALIZADO_POR' => $this->request->getPost('actualizado_por'),
            'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),  // Asignar fecha de actualización
        ];

        if ($recursoEmpleadoModel->update($id, $data)) {
            return redirect()->to('/recursos_empleados')->with('success', 'Recurso empleado actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el recurso empleado.');
        }
    }

    // Elimina los recursos empleados seleccionados
    public function eliminar()
    {
        $recursosEmpleadosIds = $this->request->getPost('recursos_empleados');
        
        if (!empty($recursosEmpleadosIds)) {
            $recursoEmpleadoModel = new RecursoEmpleadoModel();
            $recursoEmpleadoModel->whereIn('ID_RECURSO_EMPLEADO', $recursosEmpleadosIds)->delete();
            return redirect()->to('/recursos_empleados')->with('success', 'Recursos empleados eliminados correctamente.');
        } else {
            return redirect()->to('/recursos_empleados')->with('error', 'No se seleccionó ningún recurso empleado.');
        }
    }

    // Exporta los recursos empleados a un archivo CSV
    public function exportarCSV()
    {
        $recursoEmpleadoModel = new RecursoEmpleadoModel();
        $recursosEmpleadosIds = $this->request->getPost('recursos_empleados');

        if (empty($recursosEmpleadosIds)) {
            return redirect()->back()->with('error', 'No se seleccionó ningún recurso empleado.');
        }

        $recursosEmpleados = $recursoEmpleadoModel->whereIn('ID_RECURSO_EMPLEADO', $recursosEmpleadosIds)->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="recursos_empleados_seleccionados.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID_RECURSO_EMPLEADO', 'NOMBRE', 'APELLIDO_PATERNO', 'APELLIDO_MATERNO', 'NIVEL', 'TIPO_EMPLEADO', 'ESTADO', 'FECHA_CONTRATACION', 'ID_PUESTO', 'ID_ESPECIALIDAD']);

        foreach ($recursosEmpleados as $recursoEmpleado) {
            fputcsv($output, [
                $recursoEmpleado['ID_RECURSO_EMPLEADO'],
                $recursoEmpleado['NOMBRE'],
                $recursoEmpleado['APELLIDO_PATERNO'],
                $recursoEmpleado['APELLIDO_MATERNO'],
                $recursoEmpleado['NIVEL'],
                $recursoEmpleado['TIPO_EMPLEADO'],
                $recursoEmpleado['ESTADO'],
                $recursoEmpleado['FECHA_CONTRATACION'],
                $recursoEmpleado['ID_PUESTO'],
                $recursoEmpleado['ID_ESPECIALIDAD']
            ]);
        }

        fclose($output);
        exit;
    }
}
