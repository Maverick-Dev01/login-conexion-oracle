<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">Crear Usuario</h1>
        <form action="<?php echo base_url('/usuarios/guardar'); ?>" method="post">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="apellido_paterno" class="block text-gray-700">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="apellido_materno" class="block text-gray-700">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="telefono" class="block text-gray-700">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="usuario" class="block text-gray-700">Usuario:</label>
                <input type="text" id="usuario" name="usuario" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="contrasenia" class="block text-gray-700">Contraseña:</label>
                <input type="password" id="contrasenia" name="contrasenia" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="id_rol" class="block text-gray-700">Rol:</label>
                <select id="id_rol" name="id_rol" class="w-full px-3 py-2 border rounded" required>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= $rol['ID_ROL']; ?>"><?= $rol['NOMBRE_ROL']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Usuario</button>
            </div>
        </form>
    </div>
</body>
</html>
