<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\RolModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class UsuariosController extends Controller
{
    // Muestra la lista de usuarios
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $rolModel = new RolModel();
    
        $query = $this->request->getGet('query');
        
        // Obtener los usuarios basados en el término de búsqueda si existe
        $usuarios = $query
            ? $usuarioModel->like('NOMBRE', $query)
                           ->orLike('APELLIDO_PATERNO', $query)
                           ->orLike('EMAIL', $query)
                           ->findAll()
            : $usuarioModel->findAll();
        
        // Obtener todos los roles y crear un mapa de ID de rol a nombre de rol
        $roles = $rolModel->findAll();
        $rolMap = [];
        foreach ($roles as $rol) {
            $rolMap[$rol['ID_ROL']] = $rol['NOMBRE_ROL'];
        }
    
        // Asignar el nombre del rol a cada usuario
        foreach ($usuarios as &$usuario) {
            $usuario['NOMBRE_ROL'] = $rolMap[$usuario['ID_ROL']] ?? 'Desconocido';
        }
    
        return view('usuarios/lista', [
            'usuarios' => $usuarios,
            'query' => $query
        ]);
    }
    

    public function create()
    {
        $rolModel = new RolModel();
        $data['roles'] = $rolModel->findAll();
        return view('usuarios/crear', $data);
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     */
    public function store()
    {
        $usuarioModel = new UsuarioModel();

        $data = [
            'NOMBRE' => $this->request->getPost('nombre'),
            'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
            'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
            'TELEFONO' => $this->request->getPost('telefono'),
            'EMAIL' => $this->request->getPost('email'),
            'USUARIO' => $this->request->getPost('usuario'),
            'CONTRASENIA' => password_hash($this->request->getPost('contrasenia'), PASSWORD_DEFAULT),
            'ID_ROL' => $this->request->getPost('id_rol'),
        ];

        if ($usuarioModel->insertUsuario($data)) {
            return redirect()->to('/usuarios')->with('success', 'Usuario creado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar el usuario.');
        }
    }

    // Muestra un usuario específico
    public function show($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado.');
        }

        return view('usuarios/ver', ['usuario' => $usuario]);
    }

    // Muestra el formulario para editar un usuario
    public function edit($id)
    {
        $usuarioModel = new UsuarioModel();
        $rolModel = new RolModel();

        $usuario = $usuarioModel->find($id);
        $roles = $rolModel->findAll();

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado.');
        }

        return view('usuarios/editar', ['usuario' => $usuario, 'roles' => $roles]);
    }

    public function update($id)
{
    $usuarioModel = new UsuarioModel();

    $data = [
        'NOMBRE' => $this->request->getPost('nombre'),
        'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
        'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
        'TELEFONO' => $this->request->getPost('telefono'),
        'EMAIL' => $this->request->getPost('email'),
        'USUARIO' => $this->request->getPost('usuario'),
        'ID_ROL' => $this->request->getPost('id_rol'),
    ];

    if ($usuarioModel->update($id, $data)) {
        return redirect()->to('/usuarios')->with('success', 'Usuario actualizado correctamente.');
    } else {
        return redirect()->back()->with('error', 'Error al actualizar el usuario.');
    }
}


    // Elimina los usuarios seleccionados
    public function eliminar()
    {
        $usuariosIds = $this->request->getPost('usuarios');
        
        if (!empty($usuariosIds)) {
            $usuarioModel = new UsuarioModel();
            $usuarioModel->whereIn('ID_USUARIO', $usuariosIds)->delete();
            return redirect()->to('/usuarios')->with('success', 'Usuarios eliminados correctamente.');
        } else {
            return redirect()->to('/usuarios')->with('error', 'No se seleccionó ningún usuario.');
        }
    }

    // Exporta los usuarios a un archivo CSV
    public function exportarCSV()
{
    $usuarioModel = new UsuarioModel();

    // Obtener los IDs seleccionados desde el formulario
    $usuariosIds = $this->request->getPost('usuarios');

    // Validar si hay IDs seleccionados
    if (empty($usuariosIds)) {
        return redirect()->back()->with('error', 'No se seleccionó ningún usuario.');
    }

    // Obtener solo los usuarios seleccionados
    $usuarios = $usuarioModel->whereIn('ID_USUARIO', $usuariosIds)->findAll();

    // Establecer cabeceras para la descarga del archivo CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="usuarios_seleccionados.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Abrir el flujo de salida de PHP para escribir en él
    $output = fopen('php://output', 'w');

    // Escribir los encabezados del CSV
    fputcsv($output, ['ID_USUARIO', 'NO_USUARIO', 'NOMBRE', 'APELLIDO_PATERNO', 'APELLIDO_MATERNO', 'TELEFONO', 'EMAIL', 'USUARIO', 'ROL']);

    // Escribir los datos de los usuarios seleccionados
    foreach ($usuarios as $usuario) {
        fputcsv($output, [
            $usuario['ID_USUARIO'],
            $usuario['NO_USUARIO'],
            $usuario['NOMBRE'],
            $usuario['APELLIDO_PATERNO'],
            $usuario['APELLIDO_MATERNO'],
            $usuario['TELEFONO'],
            $usuario['EMAIL'],
            $usuario['USUARIO'],
            $usuario['ID_ROL']
        ]);
    }

    // Cerrar el flujo de salida
    fclose($output);
    exit;
}

public function exportToPDF()
{
    $usuarioModel = new UsuarioModel();
    $usuarios = $usuarioModel->findAll();

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
    $html .= '<h2 style="text-align: center;">Lista de Usuarios</h2>';
    $html .= '<table><thead><tr>
                <th>ID</th>
                <th>Número de Usuario</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Rol</th>
             </tr></thead><tbody>';

    foreach ($usuarios as $usuario) {
        $html .= '<tr>
                    <td>' . $usuario['ID_USUARIO'] . '</td>
                    <td>' . $usuario['NO_USUARIO'] . '</td>
                    <td>' . $usuario['NOMBRE'] . '</td>
                    <td>' . $usuario['APELLIDO_PATERNO'] . '</td>
                    <td>' . $usuario['APELLIDO_MATERNO'] . '</td>
                    <td>' . $usuario['TELEFONO'] . '</td>
                    <td>' . $usuario['EMAIL'] . '</td>
                    <td>' . $usuario['USUARIO'] . '</td>
                    <td>' . $usuario['ID_ROL'] . '</td>
                 </tr>';
    }

    $html .= '</tbody></table></body></html>';

    // Generar el PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Descargar el archivo PDF
    $dompdf->stream('lista_usuarios.pdf', array("Attachment" => 1));
}
    
}
