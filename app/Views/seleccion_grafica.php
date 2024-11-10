<!-- views/seleccion_grafica.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Gráfica</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Seleccionar Gráfica</h2>

        <form id="seleccionForm">
            <div class="mb-4">
                <label for="tipo_grafica" class="block text-gray-700 font-bold mb-2">Tipo de Gráfica:</label>
                <select id="tipo_grafica" name="tipo_grafica" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm">
                    <option value="proyectos">Proyectos</option>
                    <option value="tareas">Tareas</option>
                    <option value="recursos">Recursos</option>
                    <option value="reuniones">Reuniones</option>
                </select>
            </div>

            <!-- Filtros adicionales dinámicos -->
            <div id="filtrosContainer" class="mb-4">
                <!-- Los filtros específicos se cargarán aquí dependiendo del tipo de gráfica -->
            </div>

            <div class="flex justify-center space-x-4 mt-6">
                <button type="button" onclick="generarGrafica()" class="bg-blue-600 text-white px-6 py-3 rounded-lg">Generar Gráfica</button>
                <button type="button" onclick="exportarGrafica()" class="bg-green-600 text-white px-6 py-3 rounded-lg">Exportar Gráfica</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript para manejar la selección de tipo y los filtros específicos
        document.getElementById('tipo_grafica').addEventListener('change', actualizarFiltros);

        function actualizarFiltros() {
            const tipo = document.getElementById('tipo_grafica').value;
            const filtrosContainer = document.getElementById('filtrosContainer');
            filtrosContainer.innerHTML = '';

            if (tipo === 'proyectos') {
                filtrosContainer.innerHTML = `
                    <label class="block text-gray-700 font-bold mb-2">Filtro de Estado:</label>
                    <select name="estado" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm">
                        <option value="todos">Todos</option>
                        <option value="en_curso">En Curso</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="finalizado">Finalizado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                    <label class="block text-gray-700 font-bold mb-2 mt-4">Proyecto específico:</label>
                    <input type="text" name="id_proyecto" placeholder="ID Proyecto (opcional)" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm">
                `;
            } else if (tipo === 'tareas') {
                filtrosContainer.innerHTML = `
                    <label class="block text-gray-700 font-bold mb-2">Filtrar por Prioridad:</label>
                    <select name="prioridad" class="bg-white p-3 px-4 w-full rounded-lg border border-gray-300 shadow-sm">
                        <option value="todas">Todas</option>
                        <option value="alta">Alta</option>
                        <option value="media">Media</option>
                        <option value="baja">Baja</option>
                    </select>
                `;
            }
            // Agrega más condiciones para cada tipo de gráfica si es necesario
        }

        function generarGrafica() {
            const form = document.getElementById('seleccionForm');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();
            const tipoGrafica = formData.get('tipo_grafica');

            // Redirige a la gráfica con los filtros aplicados
            window.location.href = `/graficas/${tipoGrafica}?${params}`;
        }


        function exportarGrafica() {
            // Aquí puedes implementar la funcionalidad para exportar la gráfica
            alert("Función de exportación aún en desarrollo.");
        }

        // Cargar filtros iniciales al cargar la página
        actualizarFiltros();
    </script>
</body>

</html>