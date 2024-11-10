<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use CodeIgniter\Controller;

class ClientesController extends Controller
{
    // Muestra la lista de clientes
    public function index()
    {
        $clienteModel = new ClienteModel();
        $query = $this->request->getGet('query');
        
        // Obtener los clientes basados en el término de búsqueda si existe
        $clientes = $query
            ? $clienteModel->like('NO_CLIENTE', $query)
                           ->orLike('RAZON_SOCIAL', $query)
                           ->orLike('NOMBRE_COMERCIAL', $query)
                           ->findAll()
            : $clienteModel->findAll();
    
        return view('clientes/lista', [
            'clientes' => $clientes,
            'query' => $query
        ]);
    }

    public function create()
    {
        return view('clientes/crear');
    }

    // Guarda un nuevo cliente en la base de datos.
    public function store()
    {
        $clienteModel = new ClienteModel();

        $data = [
            'NO_CLIENTE' => $this->request->getPost('no_cliente'),
            'RAZON_SOCIAL' => $this->request->getPost('razon_social'),
            'NOMBRE_COMERCIAL' => $this->request->getPost('nombre_comercial'),
            'GIRO' => $this->request->getPost('giro'),
            'RFC' => $this->request->getPost('rfc'),
            'NOMBRE_REPRESENTANTE' => $this->request->getPost('nombre_representante'),
            'TELEFONO_REPRESENTANTE' => $this->request->getPost('telefono_representante'),
            'STATUS_CLIENTE' => $this->request->getPost('status_cliente'),
            'FECHA_CREACION' => date('Y-m-d H:i:s'),  // Asignar fecha de creación
            'ID_DOMICILIO' => $this->request->getPost('id_domicilio'),
        ];

        if ($clienteModel->insertCliente($data)) {
            return redirect()->to('/clientes')->with('success', 'Cliente creado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar el cliente.');
        }
    }

    // Muestra un cliente específico
    public function show($id)
    {
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->find($id);

        if (!$cliente) {
            return redirect()->to('/clientes')->with('error', 'Cliente no encontrado.');
        }

        return view('clientes/ver', ['cliente' => $cliente]);
    }

    // Muestra el formulario para editar un cliente
    public function edit($id)
    {
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->find($id);

        if (!$cliente) {
            return redirect()->to('/clientes')->with('error', 'Cliente no encontrado.');
        }

        return view('clientes/editar', ['cliente' => $cliente]);
    }

    // Actualiza los datos de un cliente existente
    public function update($id)
    {
        $clienteModel = new ClienteModel();

        $data = [
            'NO_CLIENTE' => $this->request->getPost('no_cliente'),
            'RAZON_SOCIAL' => $this->request->getPost('razon_social'),
            'NOMBRE_COMERCIAL' => $this->request->getPost('nombre_comercial'),
            'GIRO' => $this->request->getPost('giro'),
            'RFC' => $this->request->getPost('rfc'),
            'NOMBRE_REPRESENTANTE' => $this->request->getPost('nombre_representante'),
            'TELEFONO_REPRESENTANTE' => $this->request->getPost('telefono_representante'),
            'STATUS_CLIENTE' => $this->request->getPost('status_cliente'),
            'ACTUALIZADO_POR' => $this->request->getPost('actualizado_por'),
            'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),  // Asignar fecha de actualización
            'ID_DOMICILIO' => $this->request->getPost('id_domicilio'),
        ];

        if ($clienteModel->update($id, $data)) {
            return redirect()->to('/clientes')->with('success', 'Cliente actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el cliente.');
        }
    }

    // Elimina los clientes seleccionados
    public function eliminar()
    {
        $clientesIds = $this->request->getPost('clientes');
        
        if (!empty($clientesIds)) {
            $clienteModel = new ClienteModel();
            $clienteModel->whereIn('ID_CLIENTE', $clientesIds)->delete();
            return redirect()->to('/clientes')->with('success', 'Clientes eliminados correctamente.');
        } else {
            return redirect()->to('/clientes')->with('error', 'No se seleccionó ningún cliente.');
        }
    }

    // Exporta los clientes a un archivo CSV
    public function exportarCSV()
    {
        $clienteModel = new ClienteModel();
        $clientesIds = $this->request->getPost('clientes');

        if (empty($clientesIds)) {
            return redirect()->back()->with('error', 'No se seleccionó ningún cliente.');
        }

        $clientes = $clienteModel->whereIn('ID_CLIENTE', $clientesIds)->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="clientes_seleccionados.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID_CLIENTE', 'NO_CLIENTE', 'RAZON_SOCIAL', 'NOMBRE_COMERCIAL', 'GIRO', 'RFC', 'NOMBRE_REPRESENTANTE', 'TELEFONO_REPRESENTANTE', 'STATUS_CLIENTE']);

        foreach ($clientes as $cliente) {
            fputcsv($output, [
                $cliente['ID_CLIENTE'],
                $cliente['NO_CLIENTE'],
                $cliente['RAZON_SOCIAL'],
                $cliente['NOMBRE_COMERCIAL'],
                $cliente['GIRO'],
                $cliente['RFC'],
                $cliente['NOMBRE_REPRESENTANTE'],
                $cliente['TELEFONO_REPRESENTANTE'],
                $cliente['STATUS_CLIENTE']
            ]);
        }

        fclose($output);
        exit;
    }
}
