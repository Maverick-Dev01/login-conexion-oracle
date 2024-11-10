<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reunión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-6xl mx-auto">
        <!-- Título del Formulario -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Editar Reunión</h2>

        <!-- Formulario de Edición de Reunión en 3 columnas -->
        <form action="<?= base_url('/reuniones/update/' . $reunion['ID_REUNION']); ?>" method="POST">

            <!-- Estructura de tipo tabla en 3 columnas -->
            <div class="grid grid-cols-3 gap-6 text-gray-700 font-semibold mb-8">
                <!-- Columna Izquierda -->
                <div>
                    <label for="nombre_reunion" class="block mb-1">Nombre de la Reunión:</label>
                    <input type="text" id="nombre_reunion" name="nombre_reunion" value="<?= $reunion['NOMBRE_REUNION']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="no_reunion" class="block mt-4 mb-1">Número de Reunión:</label>
                    <input type="text" id="no_reunion" name="no_reunion" value="<?= $reunion['NO_REUNION']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="area" class="block mt-4 mb-1">Área:</label>
                    <input type="text" id="area" name="area" value="<?= $reunion['AREA']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>
                </div>

                <!-- Columna Central -->
                <div>
                    <label for="fecha_comienzo" class="block mb-1">Fecha de Comienzo:</label>
                    <input type="date" id="fecha_comienzo" name="fecha_comienzo" value="<?= $reunion['FECHA_COMIENZO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="hora_comienzo" class="block mt-4 mb-1">Hora de Comienzo:</label>
                    <input type="time" id="hora_comienzo" name="hora_comienzo" value="<?= $reunion['HORA_COMIENZO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="estatus_reunion" class="block mt-4 mb-1">Estatus de la Reunión:</label>
                    <select id="estatus_reunion" name="estatus_reunion" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                        <option value="Pendiente" <?= $reunion['ESTATUS_REUNION'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                        <option value="En Curso" <?= $reunion['ESTATUS_REUNION'] == 'En Curso' ? 'selected' : ''; ?>>En Curso</option>
                        <option value="Completada" <?= $reunion['ESTATUS_REUNION'] == 'Completada' ? 'selected' : ''; ?>>Completada</option>
                    </select>
                </div>

                <!-- Columna Derecha -->
                <div>
                    <label for="plataforma" class="block mb-1">Plataforma:</label>
                    <input type="text" id="plataforma" name="plataforma" value="<?= $reunion['PLATAFORMA']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="link" class="block mt-4 mb-1">Link de la Reunión:</label>
                    <input type="url" id="link" name="link" value="<?= $reunion['LINK']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="detalles" class="block mt-4 mb-1">Detalles:</label>
                    <textarea id="detalles" name="detalles" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" rows="2"><?= $reunion['DETALLES']; ?></textarea>
                </div>
            </div>

            <!-- Campo de Proyecto Asociado -->
            <div class="mb-6">
                <label for="id_proyecto" class="block mb-1 text-gray-700 font-semibold">Proyecto Asociado:</label>
                <select id="id_proyecto" name="id_proyecto" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                    <?php foreach ($proyectos as $proyecto): ?>
                        <option value="<?= $proyecto['ID_PROYECTO']; ?>" <?= $proyecto['ID_PROYECTO'] == $reunion['ID_PROYECTO'] ? 'selected' : ''; ?>>
                            <?= $proyecto['NOMBRE_PROYECTO']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Botones de Actualizar y Cancelar -->
            <div class="flex justify-center space-x-6 mt-8">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Actualizar
                </button>
                <a href="<?= base_url('/reuniones'); ?>" class="bg-red-500 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>
