<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Progreso de Proyectos</h2>

        <!-- Contenedor de la Gráfica -->
        <canvas id="graficaProyectos" width="600" height="400"></canvas>

        <!-- Botones de control -->
        <div class="flex justify-center space-x-4 mt-6">
            <button onclick="exportarGrafica()" class="bg-green-600 text-white px-6 py-3 rounded-lg">Exportar como PDF</button>
            <a href="/graficas" class="bg-gray-600 text-white px-6 py-3 rounded-lg">Regresar</a>
        </div>
    </div>

    <script>
        async function obtenerDatosProyectos() {
            const urlParams = new URLSearchParams(window.location.search);
            const respuesta = await fetch(`/graficas/datos/proyectos?${urlParams}`);
            const proyectos = await respuesta.json();
            return proyectos;
        }

        async function crearGraficaProyectos() {
            const proyectos = await obtenerDatosProyectos();
            
            const etiquetas = proyectos.map(p => p.NOMBRE_PROYECTO);
            const diasDesvio = proyectos.map(p => p.DIAS_DESVIO ?? 0);
            const avancePlaneado = proyectos.map(p => p.AVANCE_PLANEADO ?? 0);
            const avanceReal = proyectos.map(p => p.AVANCE_REAL ?? 0);

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
                            max: 100
                        }
                    }
                }
            };

            new Chart(
                document.getElementById('graficaProyectos'),
                config
            );
        }

        function exportarGrafica() {
            const canvas = document.getElementById('graficaProyectos');

            html2canvas(canvas).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();

                const imgWidth = 190; // Ancho en mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                pdf.save('grafica_proyectos.pdf'); // Nombre del archivo PDF
            });
        }

        document.addEventListener('DOMContentLoaded', crearGraficaProyectos);
    </script>
</body>
</html>
