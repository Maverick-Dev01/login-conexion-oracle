<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div id="taskDetails" class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-gray-700 mb-6 text-center">Detalles de la Tarea</h2>
        
        <div class="space-y-4 text-lg">
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">ID de la Tarea:</span>
                <span class="text-gray-800 font-medium"><?= $tarea['ID_TAREA']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Nombre de la Tarea:</span>
                <span class="text-gray-800 font-medium"><?= $tarea['NOMBRE_TAREA']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Descripción:</span>
                <span class="text-gray-800 font-medium"><?= $tarea['DESCRIPCION']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Líder:</span>
                <span class="text-gray-800 font-medium"><?= $tarea['LIDER']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Fecha de Inicio:</span>
                <span class="text-gray-800 font-medium"><?= $tarea['FECHA_INICIO']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Fecha de Finalización:</span>
                <span class="text-gray-800 font-medium"><?= $tarea['FECHA_FIN']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Prioridad:</span>
                <span class="text-gray-800 font-medium"><?= $tarea['PRIORIDAD']; ?></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-600">Estado:</span>
                <span class="text-gray-800 font-medium"><?= $tarea['ESTADO_TAREA']; ?></span>
            </div>
        </div>

        <!-- Botones de Regresar y Exportar a PDF -->
        <div class="mt-6 flex justify-center space-x-4">
            <!-- Botón de Regresar -->
            <a href="javascript:history.back()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Regresar
            </a>

            <!-- Botón para Exportar a PDF usando jsPDF en el cliente -->
            <button onclick="exportToPDF()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Exportar a PDF
            </button>
        </div>
    </div>

    <script>
        // Función para exportar los detalles a PDF usando jsPDF
        function exportToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.setFontSize(18);
            doc.text("Detalles de la Tarea", 20, 20);

            // Obtenemos el contenido del div con ID "taskDetails"
            const taskDetails = document.getElementById("taskDetails").innerText;
            doc.setFontSize(12);
            doc.text(taskDetails, 20, 30);

            // Guardamos el PDF
            doc.save("detalles_tarea.pdf");
        }
    </script>

</body>
</html>
