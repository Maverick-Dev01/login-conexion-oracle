<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-2xl mx-auto">
        <!-- Título del Formulario -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Editar Usuario</h2>

        <!-- Formulario de Edición de Usuario en 2 columnas -->
        <form action="<?= base_url('/usuarios/update/' . $usuario['ID_USUARIO']); ?>" method="POST">

            <!-- Estructura de tipo tabla en 2 columnas -->
            <div class="grid grid-cols-2 gap-8 text-gray-700 font-semibold mb-8">
                <!-- Columna Izquierda -->
                <div>
                    <label for="nombre" class="block mb-1">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $usuario['NOMBRE']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="apellido_materno" class="block mt-6 mb-1">Apellido Materno:</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" value="<?= $usuario['APELLIDO_MATERNO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="email" class="block mt-6 mb-1">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $usuario['EMAIL']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="rol" class="block mt-6 mb-1">Rol:</label>
                    <select id="id_rol" name="id_rol" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= $rol['ID_ROL']; ?>" <?= $rol['ID_ROL'] == $usuario['ID_ROL'] ? 'selected' : ''; ?>>
                                <?= $rol['NOMBRE_ROL']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Columna Derecha -->
                <div>
                    <label for="apellido_paterno" class="block mb-1">Apellido Paterno:</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?= $usuario['APELLIDO_PATERNO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="telefono" class="block mt-6 mb-1">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?= $usuario['TELEFONO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="usuario" class="block mt-6 mb-1">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" value="<?= $usuario['USUARIO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>
                </div>
            </div>

            <!-- Botones de Actualizar y Cancelar -->
            <div class="flex justify-center space-x-6 mt-8">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Actualizar
                </button>
                <a href="<?= base_url('/usuarios'); ?>" class="bg-red-500 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>
