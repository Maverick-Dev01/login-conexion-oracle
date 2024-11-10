<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Progreso de Proyectos</h2>

        <!-- Contenedor de la Gráfica -->
        <canvas id="graficaProyectos" width="600" height="400"></canvas>
    </div>

    <script>
        async function obtenerDatosProyectos() {
            const respuesta = await fetch('/graficas/datos/proyectos');
            const proyectos = await respuesta.json();
            return proyectos;
        }

        async function crearGraficaProyectos() {
            const proyectos = await obtenerDatosProyectos();
            
            const etiquetas = proyectos.map(p => p.NOMBRE_PROYECTO);
            const diasDesvio = proyectos.map(p => p.DIAS_DESVIO);
            const avancePlaneado = proyectos.map(p => p.AVANCE_PLANEADO);
            const avanceReal = proyectos.map(p => p.AVANCE_REAL);

            const data = {
                labels: etiquetas,
                datasets: [
                    {
                        label: 'Desvío en Días',
                        data: diasDesvio,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)', // Rojo
                    },
                    {
                        label: 'Avance Planeado (%)',
                        data: avancePlaneado,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)', // Verde
                    },
                    {
                        label: 'Avance Real (%)',
                        data: avanceReal,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)', // Azul
                    }
                ]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            max: 100 // Ajusta según el máximo necesario (por ejemplo, para %)
                        }
                    }
                }
            };

            new Chart(
                document.getElementById('graficaProyectos'),
                config
            );
        }

        // Cargar el gráfico cuando la página esté lista
        document.addEventListener('DOMContentLoaded', crearGraficaProyectos);
    </script>
</body>
</html>
