<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-6xl mx-auto">
        <!-- Título del Formulario -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Editar Tarea</h2>

        <!-- Formulario de Edición de Tarea en 3 columnas -->
        <form action="<?= base_url('/tareas/update/' . $tarea['ID_TAREA']); ?>" method="POST">

            <!-- Estructura de tipo tabla en 3 columnas -->
            <div class="grid grid-cols-3 gap-6 text-gray-700 font-semibold mb-8">
                <!-- Columna Izquierda -->
                <div>
                    <label for="nombre_tarea" class="block mb-1">Nombre de la Tarea:</label>
                    <input type="text" id="nombre_tarea" name="nombre_tarea" value="<?= $tarea['NOMBRE_TAREA']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="lider" class="block mt-4 mb-1">Líder:</label>
                    <input type="text" id="lider" name="lider" value="<?= $tarea['LIDER']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="prioridad" class="block mt-4 mb-1">Prioridad:</label>
                    <input type="text" id="prioridad" name="prioridad" value="<?= $tarea['PRIORIDAD']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                </div>

                <!-- Columna Central -->
                <div>
                    <label for="estado_tarea" class="block mb-1">Estado de la Tarea:</label>
                    <select id="estado_tarea" name="estado_tarea" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                        <option value="Pendiente" <?= $tarea['ESTADO_TAREA'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                        <option value="En Progreso" <?= $tarea['ESTADO_TAREA'] == 'En Progreso' ? 'selected' : ''; ?>>En Progreso</option>
                        <option value="Completada" <?= $tarea['ESTADO_TAREA'] == 'Completada' ? 'selected' : ''; ?>>Completada</option>
                    </select>

                    <label for="fecha_inicio" class="block mt-4 mb-1">Fecha de Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?= $tarea['FECHA_INICIO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="fecha_fin" class="block mt-4 mb-1">Fecha de Finalización:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="<?= $tarea['FECHA_FIN']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                </div>

                <!-- Columna Derecha -->
                <div>
                    <label for="descripcion" class="block mb-1">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" rows="6" required><?= $tarea['DESCRIPCION']; ?></textarea>
                </div>
            </div>

            <!-- Campo de Proyecto Asociado -->
            <div class="mb-6">
                <label for="id_proyecto" class="block mb-1 text-gray-700 font-semibold">Proyecto Asociado:</label>
                <select id="id_proyecto" name="id_proyecto" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                    <?php foreach ($proyectos as $proyecto): ?>
                        <option value="<?= $proyecto['ID_PROYECTO']; ?>" <?= $proyecto['ID_PROYECTO'] == $tarea['ID_PROYECTO'] ? 'selected' : ''; ?>>
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
                <a href="<?= base_url('/tareas'); ?>" class="bg-red-500 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>
