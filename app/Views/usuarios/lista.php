<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/patterns.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/usuarios.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="bg-gray-100">
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

    <div class="flex">
        <nav id="sidebar" class="sidebar sidebar-expanded bg-gray-900 text-white h-screen flex flex-col">
            <ul class="mt-4">
                <li class="px-6 py-3 hover:bg-gray-700">
                    <a href="<?php echo base_url('/dashboard'); ?>" class="flex items-center">
                        <span>Home</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="flex-grow p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <?php if (session()->has('success')): ?>
                    <div id="success-alert" class="bg-green-500 text-white p-3 rounded mb-4">
                        <?= session('success'); ?>
                    </div>
                <?php elseif (session()->has('error')): ?>
                    <div id="error-alert" class="bg-red-500 text-white p-3 rounded mb-4">
                        <?= session('error'); ?>
                    </div>
                <?php endif; ?>

                <div class="flex justify-between items-center mb-4">
                    <div class="relative text-gray-600 flex-grow mr-2">
                        <form action="<?= base_url('/usuarios'); ?>" method="GET">
                            <input type="search" name="query" value="<?= esc($query ?? '') ?>" placeholder="Buscar usuarios..." class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                            <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M10,18C5.59,18,2,14.41,2,10S5.59,2,10,2s8,3.59,8,8S14.41,18,10,18z M10,4C6.69,4,4,6.69,4,10s2.69,6,6,6s6-2.69,6-6S13.31,4,10,4z" />
                                    <path d="M21,22c-0.26,0-0.52-0.1-0.71-0.29L16.15,17.15c-0.39-0.39-0.39-1.02,0-1.41c0.39-0.39,1.02-0.39,1.41,0l4.14,4.14c0.39,0.39,0.39,1.02,0,1.41C21.52,21.9,21.26,22,21,22z" />
                                </svg>
                            </button>
                        </form>
                    </div>
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

                <form id="deleteForm" action="<?= base_url('/usuarios/eliminar'); ?>" method="POST">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
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
                            <tbody class="bg-white">
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr class="hover:bg-gray-100 border-b border-gray-200">
                                        <td class="px-4 py-2">
                                            <input type="checkbox" name="usuarios[]" value="<?= $usuario['ID_USUARIO']; ?>">
                                        </td>
                                        <!-- Botón Ver con icono reducido -->
                                        <td>
                                            <a href="<?= base_url('usuarios/ver/' . $usuario['ID_USUARIO']); ?>"
                                                class="bg-gray-500 text-white w-8 h-8 flex items-center justify-center rounded hover:bg-gray-600">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>
                                        </td>
                                        <!-- Botón Editar con icono reducido -->
                                        <td>
                                            <a href="<?= base_url('usuarios/editar/' . $usuario['ID_USUARIO']); ?>"
                                                class="bg-blue-500 text-white w-8 h-8 flex items-center justify-center rounded hover:bg-blue-600">
                                                <i class="fas fa-edit text-sm"></i>
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
                                        <td class="px-4 py-2"><?= $usuario['ID_ROL']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>


                        </table>
                    </div>
                </form>

                <div class="mt-4 flex justify-end">
                    <button onclick="exportCSV()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Exportar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-expanded');
            sidebar.classList.toggle('sidebar-collapsed');
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
                document.getElementById('deleteForm').submit();
            }
        }

        // function exportCSV() {
        //     document.getElementById('deleteForm').action = "<?= base_url('/usuarios/exportar'); ?>";
        //     document.getElementById('deleteForm').submit();
        // }

        setTimeout(() => {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert) errorAlert.style.display = 'none';
        }, 2000);
    </script>
</body>

</html>