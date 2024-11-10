<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-6xl mx-auto">
        <!-- Título del Formulario -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Editar Proyecto</h2>

        <!-- Formulario de Edición de Proyecto en 3 columnas -->
        <form action="<?= base_url('/proyectos/update/' . $proyecto['ID_PROYECTO']); ?>" method="POST">

            <!-- Estructura de tipo tabla en 3 columnas -->
            <div class="grid grid-cols-3 gap-6 text-gray-700 font-semibold mb-8">
                <!-- Columna Izquierda -->
                <div>
                    <label for="nombre_proyecto" class="block mb-1">Nombre del Proyecto:</label>
                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" value="<?= $proyecto['NOMBRE_PROYECTO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="area" class="block mt-4 mb-1">Área:</label>
                    <input type="text" id="area" name="area" value="<?= $proyecto['AREA']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="tipo" class="block mt-4 mb-1">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" value="<?= $proyecto['TIPO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>
                </div>

                <!-- Columna Central -->
                <div>
                    <label for="presupuesto" class="block mb-1">Presupuesto:</label>
                    <input type="number" id="presupuesto" name="presupuesto" value="<?= $proyecto['PRESUPUESTO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="prioridad" class="block mt-4 mb-1">Prioridad:</label>
                    <input type="text" id="prioridad" name="prioridad" value="<?= $proyecto['PRIORIDAD']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="estado" class="block mt-4 mb-1">Estado del Proyecto:</label>
                    <select id="estado" name="estado" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                        <option value="En Proceso" <?= $proyecto['ESTADO_PROYECTO'] == 'En Proceso' ? 'selected' : ''; ?>>En Proceso</option>
                        <option value="Completado" <?= $proyecto['ESTADO_PROYECTO'] == 'Completado' ? 'selected' : ''; ?>>Completado</option>
                        <option value="Pendiente" <?= $proyecto['ESTADO_PROYECTO'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                    </select>
                </div>

                <!-- Columna Derecha -->
                <div>
                    <label for="fecha_inicio" class="block mb-1">Fecha de Inicio Planeado:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?= $proyecto['FECHA_INICIO_PLANEADO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" required>

                    <label for="fecha_fin" class="block mt-4 mb-1">Fecha de Finalización Planeado:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="<?= $proyecto['FECHA_FIN_PLANEADO']; ?>" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">

                    <label for="descripcion" class="block mt-4 mb-1">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500" rows="2" required><?= $proyecto['DETALLES']; ?></textarea>
                </div>
            </div>

            <!-- Campo de Cliente -->
            <div class="mb-6">
                <label for="responsable" class="block mb-1 text-gray-700 font-semibold">Cliente:</label>
                <select id="responsable" name="responsable" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-blue-500">
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente['ID_CLIENTE']; ?>" <?= $cliente['ID_CLIENTE'] == $proyecto['ID_CLIENTE'] ? 'selected' : ''; ?>>
                            <?= $cliente['NOMBRE_COMERCIAL']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Botones de Actualizar y Cancelar -->
            <div class="flex justify-center space-x-6 mt-8">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Actualizar
                </button>
                <a href="<?= base_url('/proyectos'); ?>" class="bg-red-500 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>
