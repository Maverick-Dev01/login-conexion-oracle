<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Permisos</title>
    <!-- Incluye el enlace a Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">

</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center mb-6">
            <!-- Botón de regresar como enlace directo a /usuarios -->
            <a href="<?php echo base_url('/usuarios'); ?>" class="text-blue-500 hover:text-blue-600 focus:outline-none mr-2">
                <!-- Icono de flecha SVG -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Gestión de Permisos</h1>
        </div>

        <form action="/permisos/getPermisos" method="get" class="space-y-4">
            <div>
                <label for="usuario" class="block text-gray-700 font-semibold mb-2">Selecciona un usuario:</label>
                <select name="usuario_id" id="usuario" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['ID_USUARIO']; ?>"><?= $usuario['NOMBRE']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                Ver Permisos
            </button>
        </form>
    </div>
</body>

</html>
