<!-- Modal de Visualización de Usuario -->
<div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/2 p-6 relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Detalles del Usuario</h2>
        <div class="space-y-4">
            <div class="flex justify-between">
                <span class="font-semibold">ID:</span>
                <span><?= $usuario['ID_USUARIO']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Número de Usuario:</span>
                <span><?= $usuario['NO_USUARIO']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Nombre:</span>
                <span><?= $usuario['NOMBRE']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Apellido Paterno:</span>
                <span><?= $usuario['APELLIDO_PATERNO']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Apellido Materno:</span>
                <span><?= $usuario['APELLIDO_MATERNO']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Teléfono:</span>
                <span><?= $usuario['TELEFONO']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Email:</span>
                <span><?= $usuario['EMAIL']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Usuario:</span>
                <span><?= $usuario['USUARIO']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Rol:</span>
                <span><?= $usuario['ID_ROL']; ?></span>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para abrir el modal
    function openModal() {
        document.getElementById('userModal').classList.remove('hidden');
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('userModal').classList.add('hidden');
    }
</script>
