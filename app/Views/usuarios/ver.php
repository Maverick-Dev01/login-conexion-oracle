<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div id="userDetails" class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-gray-700 mb-6 text-center">Detalles del Usuario</h2>
        
        <div class="space-y-4 text-lg">
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">ID:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['ID_USUARIO']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Número de Usuario:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['NO_USUARIO']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Nombre:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['NOMBRE']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Apellido Paterno:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['APELLIDO_PATERNO']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Apellido Materno:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['APELLIDO_MATERNO']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Teléfono:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['TELEFONO']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Email:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['EMAIL']; ?></span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold text-gray-600">Usuario:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['USUARIO']; ?></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-600">Rol:</span>
                <span class="text-gray-800 font-medium"><?= $usuario['ID_ROL']; ?></span>
            </div>
        </div>

        <!-- Botones de Regresar y Exportar a PDF -->
        <div class="mt-6 flex justify-center space-x-4">
            <!-- Botón de Regresar -->
            <a href="javascript:history.back()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Regresar
            </a>

            <!-- Botón para Exportar a PDF (Opción 1: Redirección al servidor) -->
            <!-- <a href="/ruta-para-exportar-pdf?usuario_id=<?= $usuario['ID_USUARIO']; ?>" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Exportar a PDF
            </a> -->

            <!-- Botón para Exportar a PDF (Opción 2: Usando jsPDF en el cliente) -->
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
            doc.text("Detalles del Usuario", 20, 20);

            // Obtenemos el contenido del div con ID "userDetails"
            const userDetails = document.getElementById("userDetails").innerText;
            doc.setFontSize(12);
            doc.text(userDetails, 20, 30);

            // Guardamos el PDF
            doc.save("detalles_usuario.pdf");
        }
    </script>

</body>
</html>
