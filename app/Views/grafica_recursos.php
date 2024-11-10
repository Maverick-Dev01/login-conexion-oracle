<!-- views/grafica_recursos.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Recursos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Estado de Recursos</h2>

        <!-- Contenedor de la Gráfica -->
        <canvas id="graficaRecursos" width="600" height="400"></canvas>

        <!-- Botones de control -->
        <div class="flex justify-center space-x-4 mt-6">
            <button onclick="exportarGrafica()" class="bg-green-600 text-white px-6 py-3 rounded-lg">Exportar como PDF</button>
            <a href="/graficas" class="bg-gray-600 text-white px-6 py-3 rounded-lg">Regresar</a>
        </div>
    </div>

    <script>
    async function obtenerDatosRecursos() {
        const urlParams = new URLSearchParams(window.location.search);
        const respuesta = await fetch(`/graficas/datos/recursos?${urlParams}`);
        const recursos = await respuesta.json();
        return recursos;
    }

    async function crearGraficaRecursos() {
        const recursos = await obtenerDatosRecursos();
        
        const etiquetas = recursos.map(r => `${r.NOMBRE} ${r.APELLIDO_PATERNO}`);
        const estados = recursos.map(r => r.ESTADO === 'ACTIVO' ? 100 : 0);
        const niveles = recursos.map(r => r.NIVEL === 'SENIOR' ? 100 : (r.NIVEL === 'JUNIOR' ? 50 : 25));

        const data = {
            labels: etiquetas,
            datasets: [
                {
                    label: 'Estado (Activo/Inactivo)',
                    data: estados,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // Azul
                },
                {
                    label: 'Nivel (Senior/Junior)',
                    data: niveles,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)', // Verde
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
                        max: 100 // Ajusta según el máximo necesario
                    }
                }
            }
        };

        new Chart(
            document.getElementById('graficaRecursos'),
            config
        );
    }

    function exportarGrafica() {
        // Seleccionamos el elemento del canvas
        const canvas = document.getElementById('graficaRecursos');
        
        html2canvas(canvas).then((canvas) => {
            const imgData = canvas.toDataURL('image/png'); // Convertimos el canvas a imagen
            
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            // Calculamos el ancho y alto de la imagen en el PDF
            const imgWidth = 190; // Ancho en mm
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            // Agregamos la imagen al PDF
            pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
            pdf.save('grafica_recursos.pdf'); // Guardamos el PDF con el nombre
        });
    }

    document.addEventListener('DOMContentLoaded', crearGraficaRecursos);
</script>

</body>
</html>
