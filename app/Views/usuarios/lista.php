<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <!-- TailwindCSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/patterns.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/usuarios.css'); ?>">
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <button id="menu-toggle" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="ml-4 text-xl font-bold">Lista de Usuarios</h1>
        </div>
        <div>
            <span>Administrador</span>
        </div>
    </header>

    <!-- Layout principal -->
    <div class="flex">
        <!-- Menú lateral -->
        <nav id="sidebar" class="sidebar sidebar-expanded bg-gray-900 text-white h-screen flex flex-col">
            <ul class="mt-4">
                <li class="px-6 py-3 hover:bg-gray-700">
                    <a href="#" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
                        </svg>
                        <span>Proyectos</span>
                    </a>
                </li>
                <li class="px-6 py-3 hover:bg-gray-700">
                    <a href="#" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-6-8h6M4 6h16" />
                        </svg>
                        <span>Recursos</span>
                    </a>
                </li>
                <li class="px-6 py-3 hover:bg-gray-700">
                    <a href="#" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Asignaciones</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Contenido principal -->
        <div class="flex-grow p-6">
            <!-- CardView redondeado -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- Mensajes de éxito o error -->
                <?php if (session()->has('success')): ?>
                    <div class="bg-green-500 text-white p-3 rounded mb-4">
                        <?= session('success'); ?>
                    </div>
                <?php elseif (session()->has('error')): ?>
                    <div class="bg-red-500 text-white p-3 rounded mb-4">
                        <?= session('error'); ?>
                    </div>
                <?php endif; ?>

                <!-- Contenedor para el buscador y botones -->
                <div class="flex justify-between items-center mb-4">
                    <!-- Barra de búsqueda -->
                    <div class="relative text-gray-600 flex-grow mr-2">
                        <input type="search" name="search" placeholder="Buscar usuarios..." class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M10,18C5.59,18,2,14.41,2,10S5.59,2,10,2s8,3.59,8,8S14.41,18,10,18z M10,4C6.69,4,4,6.69,4,10s2.69,6,6,6s6-2.69,6-6S13.31,4,10,4z" />
                                <path d="M21,22c-0.26,0-0.52-0.1-0.71-0.29L16.15,17.15c-0.39-0.39-0.39-1.02,0-1.41c0.39-0.39,1.02-0.39,1.41,0l4.14,4.14c0.39,0.39,0.39,1.02,0,1.41C21.52,21.9,21.26,22,21,22z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Botones de acción y agregar imágenes -->
                    <div class="space-x-2">
                        <a href="<?= base_url('/usuarios/crear'); ?>">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                <img src="<?= base_url('img/icon_añadirU.png'); ?>" alt="Alta Usuario" class="icon">
                            </button>
                        </a>
                        <button onclick="deleteSelected()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-800">
                            <img src="<?= base_url('img/icon_eliminar.png'); ?>" alt="Eliminar Usuario" class="icon">
                        </button>
                    </div>
                </div>

                <!-- Tabla de usuarios -->
                <form id="deleteForm" action="<?= base_url('/usuarios/eliminar'); ?>" method="POST">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="px-4 py-2 text-left"><input type="checkbox" id="select-all"></th>
                                    <th class="px-4 py-2 text-left"></th>
                                    <th class="px-4 py-2 text-left"></th>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Número de Usuario</th>
                                    <th class="px-4 py-2 text-left">Nombre</th>
                                    <th class="px-4 py-2 text-left">Apellido Paterno</th>
                                    <th class="px-4 py-2 text-left">Apellido Materno</th>
                                    <th class="px-4 py-2 text-left">Teléfono</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Usuario</th>
                                    <th class="px-4 py-2 text-left">Rol</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr class="hover:bg-gray-100 border-b border-gray-200">
                                        <td class="px-4 py-2"><input type="checkbox" name="usuarios[]" value="<?= $usuario['ID_USUARIO']; ?>"></td>
                                        <td class="px-4 py-2">
                                            <button class="text-blue-600 hover:text-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0V6m6 6v6m-6-6h6" />
                                                </svg>
                                            </button>
                                        </td>
                                        <td class="px-4 py-2">
                                            <button class="text-green-600 hover:text-green-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </td>
                                        <td class="px-4 py-2"><?= $usuario['ID_USUARIO']; ?></td>
                                        <td class="px-4 py-2"><?= $usuario['NO_USUARIO']; ?></td>
                                        <td class="px-4 py-2"><?= $usuario['NOMBRE']; ?></td>
                                        <td class="px-4 py-2"><?= $usuario['APELLIDO_PATERNO']; ?></td>
                                        <td class="px-4 py-2"><?= $usuario['APELLIDO_MATERNO']; ?></td>
                                        <td class="px-4 py-2"><?= $usuario['TELEFONO']; ?></td>
                                        <td class="px-4 py-2"><?= $usuario['EMAIL']; ?></td>
                                        <td class="px-4 py-2"><?= $usuario['USUARIO']; ?></td>
                                        <td class="px-4 py-2"><?= $usuario['ID_ROL']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>

                <!-- Botón de exportar -->
                <div class="mt-4 flex justify-end">
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Exportar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para el menú colapsable -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', () => {
            if (sidebar.classList.contains('sidebar-expanded')) {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
            } else {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
            }
        });

        // Seleccionar todos los checkboxes
        document.getElementById('select-all').addEventListener('click', function(event) {
            const checkboxes = document.querySelectorAll('input[name="usuarios[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
        });

        function deleteSelected() {
            // Obtener los checkboxes seleccionados
            let checkboxes = document.querySelectorAll('input[name="usuarios[]"]:checked');
            if (checkboxes.length === 0) {
                alert('No se ha seleccionado ningún usuario para eliminar.');
                return;
            }

            // Confirmar la eliminación
            if (confirm('¿Estás seguro de que deseas eliminar los usuarios seleccionados?')) {
                // Si se confirma, envía el formulario de eliminación
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</body>

</html>
