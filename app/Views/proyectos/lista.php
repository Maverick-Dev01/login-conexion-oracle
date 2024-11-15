<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
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
            <h1 class="text-xl font-bold">Lista de Proyectos</h1>
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
                        <img src="<?= base_url('img/cliente.png'); ?>" alt="Permisos" class="icon">
                        <span class="ml-3">Clientes</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('/recursos_empleados'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/recurso.png'); ?>" alt="Configuraciones" class="icon">
                        <span class="ml-3">Recursos</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('/tareas'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/tarea.png'); ?>" alt="Configuraciones" class="icon">
                        <span class="ml-3">Tareas</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('/reuniones'); ?>" class="flex items-center p-2 hover:bg-gray-700 rounded-md">
                        <img src="<?= base_url('img/cita.png'); ?>" alt="Configuraciones" class="icon">
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
                        <form action="<?= base_url('/proyectos'); ?>" method="GET">
                            <input type="search" name="query" value="<?= esc($query ?? '') ?>" placeholder="Buscar proyectos..."
                                class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                            <button type="submit" class="absolute right-3 top-3">
                                <i class="fas fa-search h-4 w-4"></i>
                            </button>
                        </form>
                    </div>
                    <div class="space-x-2">
                        <button onclick="openModal()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            <img src="<?= base_url('img/icon_añadirU.png'); ?>" alt="Alta Proyecto" class="icon">
                        </button>
                        <button onclick="deleteSelected()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-800">
                            <img src="<?= base_url('img/icon_eliminar.png'); ?>" alt="Eliminar Proyecto" class="icon">
                        </button>

                        <!-- Botón de exportar a PDF -->
                        <a href="<?= base_url('/proyectos/exportToPDF'); ?>" target="_blank">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                <img src="<?= base_url('img/pdf.png'); ?>" alt="Exportar PDF" class="icon">
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Tabla de proyectos con scroll -->
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
                                        <th class="px-4 py-2">Número de Proyecto</th>
                                        <th class="px-4 py-2">Nombre del Proyecto</th>
                                        <th class="px-4 py-2">Área</th>
                                        <th class="px-4 py-2">Tipo</th>
                                        <th class="px-4 py-2">Presupuesto</th>
                                        <th class="px-4 py-2">Prioridad</th>
                                        <th class="px-4 py-2">Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($proyectos as $proyecto): ?>
                                        <tr class="hover:bg-gray-100 border-b">
                                            <td class="px-4 py-2 text-center">
                                                <input type="checkbox" name="proyectos[]" value="<?= $proyecto['ID_PROYECTO']; ?>">
                                            </td>
                                            <td class="px-4 py-2 text-center">
                                                <a href="<?= base_url('proyectos/ver/' . $proyecto['ID_PROYECTO']); ?>" class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td class="px-4 py-2 text-center">
                                                <a href="<?= base_url('proyectos/editar/' . $proyecto['ID_PROYECTO']); ?>" class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class="px-4 py-2"><?= $proyecto['ID_PROYECTO']; ?></td>
                                            <td class="px-4 py-2"><?= $proyecto['NO_PROYECTO']; ?></td>
                                            <td class="px-4 py-2"><?= $proyecto['NOMBRE_PROYECTO']; ?></td>
                                            <td class="px-4 py-2"><?= $proyecto['AREA']; ?></td>
                                            <td class="px-4 py-2"><?= $proyecto['TIPO']; ?></td>
                                            <td class="px-4 py-2"><?= $proyecto['PRESUPUESTO']; ?></td>
                                            <td class="px-4 py-2"><?= $proyecto['PRIORIDAD']; ?></td>
                                            <td class="px-4 py-2"><?= $proyecto['ID_CLIENTE']; ?></td>
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

    <!-- Modal para crear proyecto -->
    <div id="createProjectModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg p-6 w-3/4 max-w-5xl overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Crear Proyecto</h2>
                <button onclick="closeModal()" class="text-red-500 text-xl font-bold">&times;</button>
            </div>
            <form id="projectForm" action="<?= base_url('/proyectos/guardar'); ?>" method="POST">
                <!-- Sección 1: Información General -->
                <div id="section1" class="section">
                    <h3 class="text-xl font-semibold mb-4">Información General</h3>
                    <div class="grid grid-cols-3 gap-4">

                        <div>
                            <label class="block text-gray-700">Nombre del Proyecto:</label>
                            <input type="text" name="nombre_proyecto" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Área:</label>
                            <select name="area" class="w-full border rounded p-2">
                                <option>TÉCNICA</option>
                                <option>FUNCIONAL</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Tipo:</label>
                            <select name="tipo" class="w-full border rounded p-2">
                                <option>SOPORTE</option>
                                <option>DESARROLLO</option>
                                <option>MANTENIMIENTO</option>
                                <option>CAMBIO</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Detalles:</label>
                            <textarea name="detalles" class="w-full border rounded p-2"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700">Presupuesto:</label>
                            <input type="number" step="0.01" name="presupuesto" class="w-full border rounded p-2">
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Fechas y Progreso -->
                <div id="section2" class="section hidden">
                    <h3 class="text-xl font-semibold mb-4">Fechas y Progreso</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700">Fecha Inicio Planeado:</label>
                            <input type="date" name="fecha_inicio_planeado" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Fecha Fin Planeado:</label>
                            <input type="date" name="fecha_fin_planeado" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Fecha Inicio Real:</label>
                            <input type="date" name="fecha_inicio_real" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Fecha Fin Real:</label>
                            <input type="date" name="fecha_fin_real" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Avance Planeado (%):</label>
                            <input type="number" name="avance_planeado" class="w-full border rounded p-2" min="0" max="100">
                        </div>
                        <div>
                            <label class="block text-gray-700">Avance Real (%):</label>
                            <input type="number" name="avance_real" class="w-full border rounded p-2" min="0" max="100">
                        </div>
                    </div>
                </div>

                <!-- Sección 3: Estado y Cliente -->
                <div id="section3" class="section hidden">
                    <h3 class="text-xl font-semibold mb-4">Estado y Cliente</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700">Días Desvío:</label>
                            <input type="number" name="dias_desvio" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Fase:</label>
                            <select name="fase" class="w-full border rounded p-2">
                                <option>ANÁLISIS</option>
                                <option>DISEÑO</option>
                                <option>DESARROLLO</option>
                                <option>IMPLEMENTACIÓN</option>
                                <option>AJUSTES</option>
                                <option>DOCUMENTACIÓN</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Estado del Proyecto:</label>
                            <select name="estado_proyecto" class="w-full border rounded p-2">
                                <option>COMENZADO</option>
                                <option>EN CURSO</option>
                                <option>PENDIENTE</option>
                                <option>FINALIZADO</option>
                                <option>CANCELADO</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Cliente:</label>
                            <select name="id_cliente" class="w-full border rounded p-2">
                                <?php foreach ($clientes as $cliente): ?>
                                    <option value="<?= $cliente['ID_CLIENTE']; ?>"><?= $cliente['RAZON_SOCIAL']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Navegación de secciones -->
                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevSection()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hidden" id="prevButton">Anterior</button>
                    <button type="button" onclick="nextSection()" class="bg-blue-500 text-white px-4 py-2 rounded-lg" id="nextButton">Siguiente</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hidden" id="submitButton">Guardar Proyecto</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        let currentSection = 1;

        function showSection(section) {
            // Ocultar todas las secciones
            document.querySelectorAll('.section').forEach(sec => sec.classList.add('hidden'));
            // Mostrar la sección actual
            document.getElementById('section' + section).classList.remove('hidden');

            // Control de botones de navegación
            document.getElementById('prevButton').classList.toggle('hidden', section === 1);
            document.getElementById('nextButton').classList.toggle('hidden', section === 3);
            document.getElementById('submitButton').classList.toggle('hidden', section !== 3);
        }

        function nextSection() {
            if (currentSection < 3) {
                currentSection++;
                showSection(currentSection);
            }
        }

        function prevSection() {
            if (currentSection > 1) {
                currentSection--;
                showSection(currentSection);
            }
        }

        function openModal() {
            document.getElementById('createProjectModal').classList.remove('hidden');
            currentSection = 1; // Reiniciar a la primera sección al abrir
            showSection(currentSection);
        }

        function closeModal() {
            document.getElementById('createProjectModal').classList.add('hidden');
        }

        function openModal() {
            document.getElementById('createProjectModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('createProjectModal').classList.add('hidden');
        }



        document.getElementById('select-all').addEventListener('click', function(event) {
            const checkboxes = document.querySelectorAll('input[name="proyectos[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
        });

        function deleteSelected() {
            const checkboxes = document.querySelectorAll('input[name="proyectos[]"]:checked');
            if (checkboxes.length === 0) {
                alert('No se ha seleccionado ningún proyecto para eliminar.');
                return;
            }
            if (confirm('¿Estás seguro de que deseas eliminar los proyectos seleccionados?')) {
                document.getElementById('tableForm').action = "<?= base_url('/proyectos/eliminar'); ?>";
                document.getElementById('tableForm').submit();
            }
        }

        function exportSelected() {
            const checkboxes = document.querySelectorAll('input[name="proyectos[]"]:checked');
            if (checkboxes.length === 0) {
                alert('No se ha seleccionado ningún proyecto para exportar.');
                return;
            }
            document.getElementById('tableForm').action = "<?= base_url('/proyectos/exportarCSV'); ?>";
            document.getElementById('tableForm').submit();
        }
    </script>
</body>

</html>