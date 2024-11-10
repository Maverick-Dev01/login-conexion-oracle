<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Recursos</title>
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
            <h1 class="text-xl font-bold">Lista de Recursos</h1>
        </div>
        <span>PMO</span>
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
                </li>

                <li>
                    <a href="<?php echo base_url('/proyectos'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/proyecto.png'); ?>" alt="Proyectos" class="icon">
                        <span class="ml-3">Proyectos</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('/clientes'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/cliente.png'); ?>" alt="Clientes" class="icon">
                        <span class="ml-3">Clientes</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('/recursos_empleados'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/recurso.png'); ?>" alt="Recursos" class="icon">
                        <span class="ml-3">Recursos</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('/tareas'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/tarea.png'); ?>" alt="Tareas" class="icon">
                        <span class="ml-3">Tareas</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('/reuniones'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/cita.png'); ?>" alt="Reuniones" class="icon">
                        <span class="ml-3">Reuniones</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('/graficas'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/grafica.png'); ?>" alt="Graficas" class="icon">
                        <span class="ml-3">Generar Gráficas</span>
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
                        <form action="<?= base_url('/recursos_empleados'); ?>" method="GET">
                            <input type="search" name="query" value="<?= esc($query ?? '') ?>" placeholder="Buscar recursos..."
                                class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                            <button type="submit" class="absolute right-3 top-3">
                                <i class="fas fa-search h-4 w-4"></i>
                            </button>
                        </form>
                    </div>
                    <div class="space-x-2">
                        <button onclick="openModal()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            <img src="<?= base_url('img/icon_añadirU.png'); ?>" alt="Alta Recurso" class="icon">
                        </button>
                        <button onclick="deleteSelected()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-800">
                            <img src="<?= base_url('img/icon_eliminar.png'); ?>" alt="Eliminar Recurso" class="icon">
                        </button>

                        <!-- Botón de exportar a PDF -->
                        <a href="<?= base_url('/recursos_empleados/exportToPDF'); ?>" target="_blank">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                <img src="<?= base_url('img/pdf.png'); ?>" alt="Exportar PDF" class="icon">
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Tabla de recursos con scroll -->
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
                                        <th class="px-4 py-2">Nombre</th>
                                        <th class="px-4 py-2">Apellido Paterno</th>
                                        <th class="px-4 py-2">Apellido Materno</th>
                                        <th class="px-4 py-2">Nivel</th>
                                        <th class="px-4 py-2">Tipo de Empleado</th>
                                        <th class="px-4 py-2">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recursosEmpleados as $recurso): ?>
                                        <tr class="hover:bg-gray-100 border-b">
                                            <td class="px-4 py-2 text-center">
                                                <input type="checkbox" name="recursos_empleados[]" value="<?= $recurso['ID_RECURSO_EMPLEADO']; ?>">
                                            </td>
                                            <td class="px-4 py-2 text-center">
                                                <a href="<?= base_url('recursos_empleados/ver/' . $recurso['ID_RECURSO_EMPLEADO']); ?>" class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td class="px-4 py-2 text-center">
                                                <a href="<?= base_url('recursos_empleados/editar/' . $recurso['ID_RECURSO_EMPLEADO']); ?>" class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class="px-4 py-2"><?= $recurso['ID_RECURSO_EMPLEADO']; ?></td>
                                            <td class="px-4 py-2"><?= $recurso['NOMBRE']; ?></td>
                                            <td class="px-4 py-2"><?= $recurso['APELLIDO_PATERNO']; ?></td>
                                            <td class="px-4 py-2"><?= $recurso['APELLIDO_MATERNO']; ?></td>
                                            <td class="px-4 py-2"><?= $recurso['NIVEL']; ?></td>
                                            <td class="px-4 py-2"><?= $recurso['TIPO_EMPLEADO']; ?></td>
                                            <td class="px-4 py-2"><?= $recurso['ESTADO']; ?></td>
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

    <!-- Modal para crear recurso -->
    <div id="createResourceModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center overflow-y-auto hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-3/4 max-w-5xl overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Crear Recurso</h2>
                <button onclick="closeModal()" class="text-red-500 text-xl font-bold">&times;</button>
            </div>
            <form id="resourceForm" action="<?= base_url('/recursos_empleados/guardar'); ?>" method="POST">
                <div class="grid grid-cols-3 gap-4">
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
                        <label class="block text-gray-700">Nivel:</label>
                        <input type="text" name="nivel" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Tipo de Empleado:</label>
                        <input type="text" name="tipo_empleado" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-gray-700">Estado:</label>
                        <select name="estado" class="w-full border rounded p-2">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Guardar Recurso</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('createResourceModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('createResourceModal').classList.add('hidden');
        }

        document.getElementById('select-all').addEventListener('click', function(event) {
            const checkboxes = document.querySelectorAll('input[name="recursos_empleados[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
        });

        function deleteSelected() {
            const checkboxes = document.querySelectorAll('input[name="recursos_empleados[]"]:checked');
            if (checkboxes.length === 0) {
                alert('No se ha seleccionado ningún recurso para eliminar.');
                return;
            }
            if (confirm('¿Estás seguro de que deseas eliminar los recursos seleccionados?')) {
                document.getElementById('tableForm').action = "<?= base_url('/recursos_empleados/eliminar'); ?>";
                document.getElementById('tableForm').submit();
            }
        }

        function exportSelected() {
            const checkboxes = document.querySelectorAll('input[name="recursos_empleados[]"]:checked');
            if (checkboxes.length === 0) {
                alert('No se ha seleccionado ningún recurso para exportar.');
                return;
            }
            document.getElementById('tableForm').action = "<?= base_url('/recursos_empleados/exportarCSV'); ?>";
            document.getElementById('tableForm').submit();
        }
    </script>
</body>

</html>
