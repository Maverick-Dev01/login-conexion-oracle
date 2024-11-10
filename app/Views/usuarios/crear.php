<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <!-- TailwindCSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Botón para abrir el modal -->
    <div class="container mx-auto mt-6">
        <button id="openModalBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Usuario</button>
    </div>

    <div class="container mx-auto mt-6"></div>
    <a href="<?php echo base_url('/usuarios'); ?>" class="card">
        <button id="openModalBtn" class="bg-blue-500 text-white px-4 py-2 rounded">regresar</button>

    </a>
    </div>

    <!-- Modal -->
    <div id="userModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-2/3 p-6 relative">
            <h1 class="text-2xl font-bold mb-6">Crear Usuario</h1>

            <?php if (session()->has('validation')): ?>
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <?= session('validation')->listErrors(); ?>
                </div>
            <?php elseif (session()->has('error')): ?>
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <?= session('error'); ?>
                </div>
            <?php elseif (session()->has('success')): ?>
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    <?= session('success'); ?>
                </div>
            <?php endif; ?>

            <!-- FORMULARIO DE CREACIÓN DE USUARIOS -->
            <form action="<?= base_url('/usuarios/guardar'); ?>" method="post">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="nombre" class="block text-gray-700">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div>
                        <label for="apellido_paterno" class="block text-gray-700">Apellido Paterno:</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div>
                        <label for="apellido_materno" class="block text-gray-700">Apellido Materno:</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label for="telefono" class="block text-gray-700">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" class="w-full px-3 py-2 border rounded">
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div>
                        <label for="usuario" class="block text-gray-700">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div>
                        <label for="contrasenia" class="block text-gray-700">Contraseña:</label>
                        <input type="password" id="contrasenia" name="contrasenia" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div>
                        <label for="id_rol" class="block text-gray-700">Rol:</label>
                        <select id="id_rol" name="id_rol" class="w-full px-3 py-2 border rounded" required>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?= $rol['ID_ROL']; ?>"><?= $rol['NOMBRE_ROL']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Guardar Usuario</button>
                </div>
            </form>

            <!-- Botón para cerrar el modal -->
            <button id="closeModalBtn" class="absolute top-4 right-4 text-red-600 hover:text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Abrir el modal
        document.getElementById('openModalBtn').addEventListener('click', function() {
            document.getElementById('userModal').classList.remove('hidden');
        });



        // Cerrar el modal
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('userModal').classList.add('hidden');
        });
    </script>
</body>

</html>