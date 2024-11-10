<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 h-screen overflow-hidden">

    <!-- Header fijo en la parte superior -->
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center fixed w-full z-10">
        <div class="flex items-center space-x-4">
            <button id="menu-toggle" class="text-white focus:outline-none">
                <i class="fas fa-bars h-6 w-6"></i>
            </button>
            <h1 class="text-xl font-bold">Lista de Usuarios</h1>
        </div>
        <span>Administrador</span>
    </header>

    <!-- Contenedor principal con el sidebar y contenido -->
    <div class="flex pt-16">
        <!-- Sidebar colapsable -->
        <nav id="sidebar" class="bg-gray-900 text-white transition-all duration-300 w-64 p-4 space-y-4 fixed h-full overflow-y-auto">
            <ul>
                <li>
                    <a href="<?php echo base_url('/dashboard'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-home"></i>
                        <span class="ml-3">Home</span>
                    </a>
                </li

                <li>
                    <a href="<?php echo base_url('/permisos'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                    <img src="<?= base_url('img/permisos.png'); ?>" alt="Alta Usuario" class="icon">
                        <span class="ml-3">Persmisos</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('/usuarios/configuraciones'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                    <img src="<?= base_url('img/settings.png'); ?>" alt="Alta Usuario" class="icon">
                    <span class="ml-3">Configuraciones</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Contenedor para el contenido principal -->
        <div id="main-content" class="flex-grow p-6 ml-64 transition-all duration-300 overflow-auto">
            <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
                <!-- Mensajes de éxito o error -->
                <?php if (session()->has('success')): ?>
                    <div class="bg-green-500 text-white p-3 rounded">
                        <?= session('success'); ?>
                    </div>
                <?php elseif (session()->has('error')): ?>
                    <div class="bg-red-500 text-white p-3 rounded">
                        <?= session('error'); ?>
                    </div>
                <?php endif; ?>

                <!-- Barra de búsqueda y botones de acción -->
                <div class="flex justify-between items-center">
                    <div class="relative flex-grow">
                        <form action="<?= base_url('/usuarios'); ?>" method="GET">
                            <input type="search" name="query" value="<?= esc($query ?? '') ?>" placeholder="Buscar usuarios..."
                                class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                            <button type="submit" class="absolute right-3 top-3">
                                <i class="fas fa-search h-4 w-4"></i>
                            </button>
                        </form>
                    </div>
                    <div class="space-x-2">
                        <button onclick="openModal()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            <img src="<?= base_url('img/icon_añadirU.png'); ?>" alt="Alta Usuario" class="icon">
                        </button>
                        <button onclick="deleteSelected()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-800">
                            <img src="<?= base_url('img/icon_eliminar.png'); ?>" alt="Eliminar Usuario" class="icon">
                        </button>

                        <!-- Botón de exportar a PDF -->
                        <a href="<?= base_url('/usuarios/exportToPDF'); ?>" target="_blank">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            <img src="<?= base_url('img/pdf.png'); ?>" alt="Alta Usuario" class="icon">
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Tabla de usuarios con scroll -->
                <form id="tableForm" method="POST">
                    <div class="overflow-y-auto max-h-96 border rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="px-4 py-2"><input type="checkbox" id="select-all"></th>
                                        <th class="px-4 py-2">Ver</th>
                                        <th class="px-4 py-2">Editar</th>
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">Número de Usuario</th>
                                        <th class="px-4 py-2">Nombre</th>
                                        <th class="px-4 py-2">Apellido Paterno</th>
                                        <th class="px-4 py-2">Apellido Materno</th>
                                        <th class="px-4 py-2">Teléfono</th>
                                        <th class="px-4 py-2">Email</th>
                                        <th class="px-4 py-2">Usuario</th>
                                        <th class="px-4 py-2">Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <tr class="hover:bg-gray-100 border-b">
                                            <td class="px-4 py-2 text-center">
                                                <input type="checkbox" name="usuarios[]" value="<?= $usuario['ID_USUARIO']; ?>">
                                            </td>
                                            <td class="px-4 py-2 text-center">
                                                <a href="<?= base_url('usuarios/ver/' . $usuario['ID_USUARIO']); ?>" class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td class="px-4 py-2 text-center">
                                                <a href="<?= base_url('usuarios/editar/' . $usuario['ID_USUARIO']); ?>" class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class="px-4 py-2"><?= $usuario['ID_USUARIO']; ?></td>
                                            <td class="px-4 py-2"><?= $usuario['NO_USUARIO']; ?></td>
                                            <td class="px-4 py-2"><?= $usuario['NOMBRE']; ?></td>
                                            <td class="px-4 py-2"><?= $usuario['APELLIDO_PATERNO']; ?></td>
                                            <td class="px-4 py-2"><?= $usuario['APELLIDO_MATERNO']; ?></td>
                                            <td class="px-4 py-2"><?= $usuario['TELEFONO']; ?></td>
                                            <td class="px-4 py-2"><?= $usuario['EMAIL']; ?></td>
                                            <td class="px-4 py-2"><?= $usuario['USUARIO']; ?></td>
                                            <td class="px-4 py-2"><?= $usuario['NOMBRE_ROL']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>

                <!-- Botón de exportar -->
                <button onclick="exportSelected()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 mt-4">Exportar</button>
            </div>
        </div>
    </div>

    <!-- Modal para crear usuario -->
    <div id="createUserModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Crear Usuario</h2>
                <button onclick="closeModal()" class="text-red-500 text-xl font-bold">&times;</button>
            </div>
            <form action="<?= base_url('/usuarios/guardar'); ?>" method="POST">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700">Nombre:</label>
                        <input type="text" name="nombre" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Apellido Paterno:</label>
                        <input type="text" name="apellido_paterno" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Apellido Materno:</label>
                        <input type="text" name="apellido_materno" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Teléfono:</label>
                        <input type="text" name="telefono" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Email:</label>
                        <input type="email" name="email" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Usuario:</label>
                        <input type="text" name="usuario" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Contraseña:</label>
                        <input type="password" name="contrasena" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Rol:</label>
                        <select name="rol" class="w-full border rounded p-2">
                            <option>ADMINISTRADOR</option>
                            <option>CONSULTOR</option>
                            <option>PMO</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg mt-4 hover:bg-green-600">Guardar Usuario</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('createUserModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('createUserModal').classList.add('hidden');
        }

        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('w-16');
            mainContent.classList.toggle('ml-64');
            mainContent.classList.toggle('ml-16');
        });

        document.getElementById('select-all').addEventListener('click', function(event) {
            const checkboxes = document.querySelectorAll('input[name="usuarios[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
        });

        function deleteSelected() {
            const checkboxes = document.querySelectorAll('input[name="usuarios[]"]:checked');
            if (checkboxes.length === 0) {
                alert('No se ha seleccionado ningún usuario para eliminar.');
                return;
            }
            if (confirm('¿Estás seguro de que deseas eliminar los usuarios seleccionados?')) {
                document.getElementById('tableForm').action = "<?= base_url('/usuarios/eliminar'); ?>";
                document.getElementById('tableForm').submit();
            }
        }

        function exportSelected() {
            const checkboxes = document.querySelectorAll('input[name="usuarios[]"]:checked');
            if (checkboxes.length === 0) {
                alert('No se ha seleccionado ningún usuario para exportar.');
                return;
            }
            document.getElementById('tableForm').action = "<?= base_url('/usuarios/exportarCSV'); ?>";
            document.getElementById('tableForm').submit();
        }
    </script>
</body>

</html>