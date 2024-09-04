<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">Lista de Usuarios</h1>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Apellido Paterno</th>
                    <th class="px-4 py-2">Apellido Materno</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Usuario</th>
                    <th class="px-4 py-2">Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $usuario['ID_USUARIO']; ?></td>
                        <td class="border px-4 py-2"><?= $usuario['NOMBRE']; ?></td>
                        <td class="border px-4 py-2"><?= $usuario['APELLIDO_PATERNO']; ?></td>
                        <td class="border px-4 py-2"><?= $usuario['APELLIDO_MATERNO']; ?></td>
                        <td class="border px-4 py-2"><?= $usuario['TELEFONO']; ?></td>
                        <td class="border px-4 py-2"><?= $usuario['EMAIL']; ?></td>
                        <td class="border px-4 py-2"><?= $usuario['USUARIO']; ?></td>
                        <td class="border px-4 py-2"><?= $usuario['ID_ROL']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
