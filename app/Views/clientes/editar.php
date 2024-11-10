<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-6xl mx-auto">
        <!-- Título del Formulario -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Editar Cliente</h2>

        <!-- Formulario de Edición de Cliente en 3 columnas -->
        <form action="<?= base_url('/clientes/update/' . $cliente['ID_CLIENTE']); ?>" method="POST">

            <!-- Estructura de tipo tabla en 3 columnas -->
            <div class="grid grid-cols-3 gap-6 text-gray-700 font-semibold mb-8">
                <!-- Columna Izquierda -->
                <div>
                    <label for="no_cliente" class="block mb-1">Número de Cliente:</label>
                    <input type="text" id="no_cliente" name="no_cliente" value="<?= $cliente['NO_CLIENTE']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="razon_social" class="block mt-4 mb-1">Razón Social:</label>
                    <input type="text" id="razon_social" name="razon_social" value="<?= $cliente['RAZON_SOCIAL']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="nombre_comercial" class="block mt-4 mb-1">Nombre Comercial:</label>
                    <input type="text" id="nombre_comercial" name="nombre_comercial" value="<?= $cliente['NOMBRE_COMERCIAL']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>
                </div>

                <!-- Columna Central -->
                <div>
                    <label for="giro" class="block mb-1">Giro:</label>
                    <input type="text" id="giro" name="giro" value="<?= $cliente['GIRO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="rfc" class="block mt-4 mb-1">RFC:</label>
                    <input type="text" id="rfc" name="rfc" value="<?= $cliente['RFC']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="status_cliente" class="block mt-4 mb-1">Estado del Cliente:</label>
                    <select id="status_cliente" name="status_cliente" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                        <option value="Activo" <?= $cliente['STATUS_CLIENTE'] == 'Activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="Inactivo" <?= $cliente['STATUS_CLIENTE'] == 'Inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                </div>

                <!-- Columna Derecha -->
                <div>
                    <label for="nombre_representante" class="block mb-1">Nombre del Representante:</label>
                    <input type="text" id="nombre_representante" name="nombre_representante" value="<?= $cliente['NOMBRE_REPRESENTANTE']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="telefono_representante" class="block mt-4 mb-1">Teléfono del Representante:</label>
                    <input type="text" id="telefono_representante" name="telefono_representante" value="<?= $cliente['TELEFONO_REPRESENTANTE']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="id_domicilio" class="block mt-4 mb-1">Domicilio ID:</label>
                    <input type="text" id="id_domicilio" name="id_domicilio" value="<?= $cliente['ID_DOMICILIO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <!-- Botones de Actualizar y Cancelar -->
            <div class="flex justify-center space-x-6 mt-8">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Actualizar
                </button>
                <a href="<?= base_url('/clientes'); ?>" class="bg-red-500 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>
