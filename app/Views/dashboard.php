<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold">Bienvenido, <?= $usuario; ?>!</h1>
        <p class="mt-2">Tu rol es: <?= $rol; ?></p>

        <!-- Aquí personalizas la vista según el rol -->
        <?php if ($id_rol == 1): ?>
            <!-- Vista para Administrador -->
            <div class="mt-4">
                <h2 class="text-2xl font-semibold">Sección de Administrador</h2>
                <p>Acceso completo al sistema.</p>
            </div>
        <?php elseif ($id_rol == 2): ?>
            <!-- Vista para PMO -->
            <div class="mt-4">
                <h2 class="text-2xl font-semibold">Sección de PMO</h2>
                <p>Gestión de proyectos y recursos.</p>
            </div>
        <?php else: ?>
            <!-- Vista para Consultor -->
            <div class="mt-4">
                <h2 class="text-2xl font-semibold">Sección de Consultor</h2>
                <p>Vista de proyectos asignados.</p>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="<?= base_url('/logout') ?>" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
