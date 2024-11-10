<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Recurso</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-6xl mx-auto">
        <!-- Título del Formulario -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Editar Recurso</h2>

        <!-- Formulario de Edición de Recurso en 3 columnas -->
        <form action="<?= base_url('/recursos_empleados/update/' . $recursoEmpleado['ID_RECURSO_EMPLEADO']); ?>" method="POST">

            <!-- Estructura de tipo tabla en 3 columnas -->
            <div class="grid grid-cols-3 gap-6 text-gray-700 font-semibold mb-8">
                <!-- Columna Izquierda -->
                <div>
                    <label for="nombre" class="block mb-1">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $recursoEmpleado['NOMBRE']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="apellido_paterno" class="block mt-4 mb-1">Apellido Paterno:</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?= $recursoEmpleado['APELLIDO_PATERNO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="apellido_materno" class="block mt-4 mb-1">Apellido Materno:</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" value="<?= $recursoEmpleado['APELLIDO_MATERNO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>
                </div>

                <!-- Columna Central -->
                <div>
                    <label for="nivel" class="block mb-1">Nivel:</label>
                    <input type="text" id="nivel" name="nivel" value="<?= $recursoEmpleado['NIVEL']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="tipo_empleado" class="block mt-4 mb-1">Tipo de Empleado:</label>
                    <input type="text" id="tipo_empleado" name="tipo_empleado" value="<?= $recursoEmpleado['TIPO_EMPLEADO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="estado" class="block mt-4 mb-1">Estado:</label>
                    <select id="estado" name="estado" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                        <option value="Activo" <?= $recursoEmpleado['ESTADO'] == 'Activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="Inactivo" <?= $recursoEmpleado['ESTADO'] == 'Inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                </div>

                <!-- Columna Derecha -->
                <div>
                    <label for="fecha_contratacion" class="block mb-1">Fecha de Contratación:</label>
                    <input type="date" id="fecha_contratacion" name="fecha_contratacion" value="<?= $recursoEmpleado['FECHA_CONTRATACION']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="id_puesto" class="block mt-4 mb-1">ID Puesto:</label>
                    <input type="text" id="id_puesto" name="id_puesto" value="<?= $recursoEmpleado['ID_PUESTO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="id_especialidad" class="block mt-4 mb-1">ID Especialidad:</label>
                    <input type="text" id="id_especialidad" name="id_especialidad" value="<?= $recursoEmpleado['ID_ESPECIALIDAD']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <!-- Botones de Actualizar y Cancelar -->
            <div class="flex justify-center space-x-6 mt-8">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Actualizar
                </button>
                <a href="<?= base_url('/recursos_empleados'); ?>" class="bg-red-500 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>
