<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- para patron de fondo -->
    <link rel="stylesheet" href="<?php echo base_url('css/admin_home.css'); ?>">
    <!-- paleta de colores -->
    <link rel="stylesheet" href="<?php echo base_url('css/variables.css'); ?>">
    <!-- diseño en general -->
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">

</head>

<body>

    <!-- Header -->
    <div class="header">
        <img src="<?php echo base_url('img/eks.png'); ?>" alt="Logo">
        <h2>DigiManager</h2>
        <div class="user-menu">
            <button>
                Administrador <span class="arrow">▼</span>
            </button>
            <div class="user-menu-content">
                <a href="<?php echo base_url('/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Bienvenido, <?= session()->get('usuario'); ?></h1>
        <div class="cards">
            <a href="<?php echo base_url('/usuarios/crear'); ?>" class="card">
                <img src="<?php echo base_url('img/icon_usuario_alta.png'); ?>" alt="Alta Usuarios">
                <span>Alta Usuarios</span>
            </a>

            <a href="<?php echo base_url('/usuarios'); ?>" class="card">
                <img src="<?php echo base_url('img/icon_ver_usuario.png'); ?>" alt="Ver Usuarios">
                <span>Ver Usuarios</span>
            </a>

            <a href="<?php echo base_url('/permisos'); ?>" class="card">
                <img src="<?php echo base_url('img/icon_permisos.png'); ?>" alt="Permisos">
                <span>Permisos</span>
            </a>
            <a href="<?php echo base_url('/configuracion'); ?>" class="card">
                <img src="<?php echo base_url('img/icon_configuracion.png'); ?>" alt="Configuración">
                <span>Configuración</span>
            </a>
        </div>
    </div>

    <footer>
        <p>© 2024 DigiManager. Todos los derechos reservados.</p>
    </footer>
</body>

</html>