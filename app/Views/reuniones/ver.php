<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Reunión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div id="meetingDetails" class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-gray-700 mb-6 text-center">Detalles de la Reunión</h2>
        
        <div class="space-y-4 text-lg">
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">ID de la Reunión:</span>
                <span class="text-gray-800 font-medium"><?= $reunion['ID_REUNION']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Número de Reunión:</span>
                <span class="text-gray-800 font-medium"><?= $reunion['NO_REUNION']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Nombre de la Reunión:</span>
                <span class="text-gray-800 font-medium"><?= $reunion['NOMBRE_REUNION']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Área:</span>
                <span class="text-gray-800 font-medium"><?= $reunion['AREA']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Fecha de Comienzo:</span>
                <span class="text-gray-800 font-medium"><?= $reunion['FECHA_COMIENZO']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Hora de Comienzo:</span>
                <span class="text-gray-800 font-medium"><?= $reunion['HORA_COMIENZO']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Plataforma:</span>
                <span class="text-gray-800 font-medium"><?= $reunion['PLATAFORMA']; ?></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-600">Proyecto Asociado:</span>
                <span class="text-gray-800 font-medium"><?= $reunion['ID_PROYECTO']; ?></span>
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
            doc.text("Detalles de la Reunión", 20, 20);

            // Obtenemos el contenido del div con ID "meetingDetails"
            const meetingDetails = document.getElementById("meetingDetails").innerText;
            doc.setFontSize(12);
            doc.text(meetingDetails, 20, 30);

            // Guardamos el PDF
            doc.save("detalles_reunion.pdf");
        }
    </script>

</body>
</html>
