<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas Dinámicas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Gráficas de Datos</h2>

        <!-- Filtros de Categoría -->
        <div class="mb-6">
            <label for="categoria" class="block mb-2 text-lg font-semibold text-gray-700">Selecciona Categoría:</label>
            <select id="categoria" class="bg-gray-200 p-3 rounded-lg w-full" onchange="actualizarGrafica()">
                <option value="tareas">Tareas</option>
                <option value="proyectos">Proyectos</option>
                <option value="reuniones">Reuniones</option>
                <option value="recursos">Recursos</option>
            </select>
        </div>

        <!-- Lienzo del Gráfico -->
        <canvas id="graficaCanvas" width="400" height="200"></canvas>
    </div>

    <script>
        let grafica;
        
        async function obtenerDatos(categoria) {
            const respuesta = await fetch(`/graficas/datos/${categoria}`);
            const datos = await respuesta.json();
            return datos;
        }

        function crearGrafica(datos) {
            const etiquetas = datos.map(dato => dato.nombre || dato.NOMBRE_PROYECTO || dato.NOMBRE_REUNION || dato.NOMBRE); // Ajusta según los campos de las tablas
            const cantidades = datos.map(dato => dato.cantidad || 1); // Usa 1 si quieres contar cada uno como una unidad

            const data = {
                labels: etiquetas,
                datasets: [{
                    label: 'Cantidad',
                    data: cantidades,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };

            if (grafica) {
                grafica.destroy();
            }
            
            grafica = new Chart(document.getElementById('graficaCanvas'), {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        async function actualizarGrafica() {
            const categoria = document.getElementById('categoria').value;
            const datos = await obtenerDatos(categoria);
            crearGrafica(datos);
        }

        // Cargar gráfico inicial
        window.onload = async () => {
            await actualizarGrafica();
        };
    </script>

</body>
</html>
