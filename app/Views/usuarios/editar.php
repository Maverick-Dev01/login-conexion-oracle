<div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Usuario</h2>
    <form action="<?= base_url('/usuarios/update/' . $usuario['ID_USUARIO']); ?>" method="POST">
        <div class="mb-4">
            <label class="block text-gray-700">Nombre</label>
            <input type="text" name="nombre" value="<?= $usuario['NOMBRE']; ?>" class="bg-gray-200 w-full p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" value="<?= $usuario['APELLIDO_PATERNO']; ?>" class="bg-gray-200 w-full p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Apellido Materno</label>
            <input type="text" name="apellido_materno" value="<?= $usuario['APELLIDO_MATERNO']; ?>" class="bg-gray-200 w-full p-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Teléfono</label>
            <input type="text" name="telefono" value="<?= $usuario['TELEFONO']; ?>" class="bg-gray-200 w-full p-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="<?= $usuario['EMAIL']; ?>" class="bg-gray-200 w-full p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Usuario</label>
            <input type="text" name="usuario" value="<?= $usuario['USUARIO']; ?>" class="bg-gray-200 w-full p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Rol</label>
            <select name="id_rol" class="bg-gray-200 w-full p-2 rounded">
                <?php foreach ($roles as $rol): ?>
                    <option value="<?= $rol['ID_ROL']; ?>" <?= $rol['ID_ROL'] == $usuario['ID_ROL'] ? 'selected' : ''; ?>>
                        <?= $rol['NOMBRE_ROL']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar</button>
        </div>
    </form>
</div>