<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMO - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- para patron de fondo -->
    <link rel="stylesheet" href="<?php echo base_url('css/pmo_home.css'); ?>">
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
                <?= session()->get('usuario'); ?> <span class="arrow">▼</span>
            </button>
            <div class="user-menu-content">
                <a href="<?php echo base_url('/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Bienvenido, PMO</h1>
        <div class="cards">
            <a href="<?php echo base_url('/proyectos'); ?>" class="card">
                <img src="<?php echo base_url('img/icon_proyecto.png'); ?>" alt="Proyectos">
                <span>Proyectos</span>
            </a>
            <a href="<?php echo base_url('/reuniones'); ?>" class="card">
                <img src="<?php echo base_url('img/icon_reunion.png'); ?>" alt="Reuniones">
                <span>Reuniones</span>
            </a>
            <a href="<?php echo base_url('/dashboard'); ?>" class="card">
                <img src="<?php echo base_url('img/icon_grafica.png'); ?>" alt="Dashboard">
                <span>Dashboard</span>
            </a>
        </div>
    </div>

    <footer>
        <p>© 2024 DigiManager. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
