<?php

namespace App\Controllers;

use App\Models\ProyectoModel;
use App\Models\ClienteModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProyectosController extends Controller
{
    // Muestra la lista de proyectos
    public function index()
{
    $proyectoModel = new ProyectoModel();
    $clienteModel = new ClienteModel();

    $query = $this->request->getGet('query');
    $proyectos = $query
        ? $proyectoModel->like('NOMBRE_PROYECTO', $query)
                        ->orLike('DETALLES', $query)
                        ->findAll()
        : $proyectoModel->findAll();

    $clientes = $clienteModel->findAll(); // Obtén la lista de clientes aquí
    $clienteMap = [];
    foreach ($clientes as $cliente) {
        $clienteMap[$cliente['ID_CLIENTE']] = $cliente['RAZON_SOCIAL'];
    }

    foreach ($proyectos as &$proyecto) {
        $proyecto['NOMBRE_CLIENTE'] = $clienteMap[$proyecto['ID_CLIENTE']] ?? 'Desconocido';
    }

    return view('proyectos/lista', [
        'proyectos' => $proyectos,
        'clientes' => $clientes, // Pasa $clientes a la vista
        'query' => $query
    ]);
}


    public function create()
    {
        $clienteModel = new ClienteModel();
        $data['clientes'] = $clienteModel->findAll();
        return view('proyectos/crear', $data);
    }

    /**
     * Guarda un nuevo proyecto en la base de datos.
     */
    public function store()
    {
        $proyectoModel = new ProyectoModel();

        $data = [
            'NO_PROYECTO' => $this->request->getPost('no_proyecto'),
            'NOMBRE_PROYECTO' => $this->request->getPost('nombre_proyecto'),
            'AREA' => $this->request->getPost('area'),
            'TIPO' => $this->request->getPost('tipo'),
            'DETALLES' => $this->request->getPost('detalles'),
            'PRESUPUESTO' => $this->request->getPost('presupuesto'),
            'PRIORIDAD' => $this->request->getPost('prioridad'),
            'FECHA_INICIO_PLANEADO' => $this->request->getPost('fecha_inicio_planeado'),
            'FECHA_FIN_PLANEADO' => $this->request->getPost('fecha_fin_planeado'),
            'FECHA_INICIO_REAL' => $this->request->getPost('fecha_inicio_real'),
            'FECHA_FIN_REAL' => $this->request->getPost('fecha_fin_real'),
            'AVANCE_PLANEADO' => $this->request->getPost('avance_planeado'),
            'AVANCE_REAL' => $this->request->getPost('avance_real'),
            'DIAS_DESVIO' => $this->request->getPost('dias_desvio'),
            'FASE' => $this->request->getPost('fase'),
            'ESTADO_PROYECTO' => $this->request->getPost('estado_proyecto'),
            'ACTUALIZADO_POR' => $this->request->getPost('actualizado_por'),
            'ID_CLIENTE' => $this->request->getPost('id_cliente'),
        ];

        if ($proyectoModel->insertProyecto($data)) {
            return redirect()->to('/proyectos')->with('success', 'Proyecto creado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar el proyecto.');
        }
    }

    // Muestra un proyecto específico
    public function show($id)
    {
        $proyectoModel = new ProyectoModel();
        $proyecto = $proyectoModel->find($id);

        if (!$proyecto) {
            return redirect()->to('/proyectos')->with('error', 'Proyecto no encontrado.');
        }

        return view('proyectos/ver', ['proyecto' => $proyecto]);
    }

    // Muestra el formulario para editar un proyecto
    public function edit($id)
    {
        $proyectoModel = new ProyectoModel();
        $clienteModel = new ClienteModel();

        $proyecto = $proyectoModel->find($id);
        $clientes = $clienteModel->findAll();

        if (!$proyecto) {
            return redirect()->to('/proyectos')->with('error', 'Proyecto no encontrado.');
        }

        return view('proyectos/editar', ['proyecto' => $proyecto, 'clientes' => $clientes]);
    }

    public function update($id)
    {
        $proyectoModel = new ProyectoModel();

        $data = [
            'NO_PROYECTO' => $this->request->getPost('no_proyecto'),
            'NOMBRE_PROYECTO' => $this->request->getPost('nombre_proyecto'),
            'AREA' => $this->request->getPost('area'),
            'TIPO' => $this->request->getPost('tipo'),
            'DETALLES' => $this->request->getPost('detalles'),
            'PRESUPUESTO' => $this->request->getPost('presupuesto'),
            'PRIORIDAD' => $this->request->getPost('prioridad'),
            'FECHA_INICIO_PLANEADO' => $this->request->getPost('fecha_inicio_planeado'),
            'FECHA_FIN_PLANEADO' => $this->request->getPost('fecha_fin_planeado'),
            'FECHA_INICIO_REAL' => $this->request->getPost('fecha_inicio_real'),
            'FECHA_FIN_REAL' => $this->request->getPost('fecha_fin_real'),
            'AVANCE_PLANEADO' => $this->request->getPost('avance_planeado'),
            'AVANCE_REAL' => $this->request->getPost('avance_real'),
            'DIAS_DESVIO' => $this->request->getPost('dias_desvio'),
            'FASE' => $this->request->getPost('fase'),
            'ESTADO_PROYECTO' => $this->request->getPost('estado_proyecto'),
            'ACTUALIZADO_POR' => $this->request->getPost('actualizado_por'),
            'ID_CLIENTE' => $this->request->getPost('id_cliente'),
        ];

        if ($proyectoModel->update($id, $data)) {
            return redirect()->to('/proyectos')->with('success', 'Proyecto actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el proyecto.');
        }
    }

    // Elimina los proyectos seleccionados
    public function eliminar()
    {
        $proyectosIds = $this->request->getPost('proyectos');
        
        if (!empty($proyectosIds)) {
            $proyectoModel = new ProyectoModel();
            $proyectoModel->whereIn('ID_PROYECTO', $proyectosIds)->delete();
            return redirect()->to('/proyectos')->with('success', 'Proyectos eliminados correctamente.');
        } else {
            return redirect()->to('/proyectos')->with('error', 'No se seleccionó ningún proyecto.');
        }
    }

    // Exporta los proyectos a un archivo CSV
    public function exportarCSV()
    {
        $proyectoModel = new ProyectoModel();

        // Obtener los IDs seleccionados desde el formulario
        $proyectosIds = $this->request->getPost('proyectos');

        // Validar si hay IDs seleccionados
        if (empty($proyectosIds)) {
            return redirect()->back()->with('error', 'No se seleccionó ningún proyecto.');
        }

        // Obtener solo los proyectos seleccionados
        $proyectos = $proyectoModel->whereIn('ID_PROYECTO', $proyectosIds)->findAll();

        // Establecer cabeceras para la descarga del archivo CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="proyectos_seleccionados.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Abrir el flujo de salida de PHP para escribir en él
        $output = fopen('php://output', 'w');

        // Escribir los encabezados del CSV
        fputcsv($output, ['ID_PROYECTO', 'NO_PROYECTO', 'NOMBRE_PROYECTO', 'AREA', 'TIPO', 'DETALLES', 'PRESUPUESTO', 'PRIORIDAD', 'FECHA_INICIO_PLANEADO', 'FECHA_FIN_PLANEADO', 'FECHA_INICIO_REAL', 'FECHA_FIN_REAL', 'AVANCE_PLANEADO', 'AVANCE_REAL', 'DIAS_DESVIO', 'FASE', 'ESTADO_PROYECTO', 'CLIENTE']);

        // Escribir los datos de los proyectos seleccionados
        foreach ($proyectos as $proyecto) {
            fputcsv($output, [
                $proyecto['ID_PROYECTO'],
                $proyecto['NO_PROYECTO'],
                $proyecto['NOMBRE_PROYECTO'],
                $proyecto['AREA'],
                $proyecto['TIPO'],
                $proyecto['DETALLES'],
                $proyecto['PRESUPUESTO'],
                $proyecto['PRIORIDAD'],
                $proyecto['FECHA_INICIO_PLANEADO'],
                $proyecto['FECHA_FIN_PLANEADO'],
                $proyecto['FECHA_INICIO_REAL'],
                $proyecto['FECHA_FIN_REAL'],
                $proyecto['AVANCE_PLANEADO'],
                $proyecto['AVANCE_REAL'],
                $proyecto['DIAS_DESVIO'],
                $proyecto['FASE'],
                $proyecto['ESTADO_PROYECTO'],
                $proyecto['ID_CLIENTE'],
            ]);
        }

        // Cerrar el flujo de salida
        fclose($output);
        exit;
    }

    public function exportToPDF()
    {
        $proyectoModel = new ProyectoModel();
        $proyectos = $proyectoModel->findAll();

        // Configurar opciones de Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);

        // Crear el contenido HTML para el PDF
        $html = '<html><head><style>
                    body { font-family: Helvetica, Arial, sans-serif; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { padding: 8px; border: 1px solid #ddd; text-align: center; }
                    th { background-color: #4CAF50; color: white; }
                 </style></head><body>';
        $html .= '<h2 style="text-align: center;">Lista de Proyectos</h2>';
        $html .= '<table><thead><tr>
                    <th>ID</th>
                    <th>Número de Proyecto</th>
                    <th>Nombre</th>
                    <th>Área</th>
                    <th>Tipo</th>
                    <th>Detalles</th>
                    <th>Presupuesto</th>
                    <th>Prioridad</th>
                    <th>Fase</th>
                    <th>Estado</th>
                    <th>Cliente</th>
                 </tr></thead><tbody>';

        foreach ($proyectos as $proyecto) {
            $html .= '<tr>
                        <td>' . $proyecto['ID_PROYECTO'] . '</td>
                        <td>' . $proyecto['NO_PROYECTO'] . '</td>
                        <td>' . $proyecto['NOMBRE_PROYECTO'] . '</td>
                        <td>' . $proyecto['AREA'] . '</td>
                        <td>' . $proyecto['TIPO'] . '</td>
                        <td>' . $proyecto['DETALLES'] . '</td>
                        <td>' . $proyecto['PRESUPUESTO'] . '</td>
                        <td>' . $proyecto['PRIORIDAD'] . '</td>
                        <td>' . $proyecto['FASE'] . '</td>
                        <td>' . $proyecto['ESTADO_PROYECTO'] . '</td>
                        <td>' . $proyecto['ID_CLIENTE'] . '</td>
                     </tr>';
        }

        $html .= '</tbody></table></body></html>';

        // Generar el PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Descargar el archivo PDF
        $dompdf->stream('lista_proyectos.pdf', array("Attachment" => 1));
    }
}
