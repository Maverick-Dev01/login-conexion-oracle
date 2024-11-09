<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Expletus+Sans:wght@400;600&display=swap" rel="stylesheet">

  <title>Inicio de Sesión</title>

  <style>
    .bg-image {
      background-image: url('<?php echo base_url('img/fondoProyecto.jpg'); ?>');
      background-size: cover;
      background-position: center;
      filter: blur(5px);
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    .bg-image-overlay {
      background: rgba(0, 0, 0, 0.5);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .logo {
      position: absolute;
      top: 20px;
      left: 20px;
      width: 100px;
      /* Ajusta el tamaño del logo según sea necesario */
    }

    .header-right {
      position: absolute;
      top: 20px;
      right: 20px;
      display: flex;
      align-items: center;
      color: white;
    }

    .header-right img {
      width: 30px;
      /* Ajusta el tamaño del icono según sea necesario */
      margin-right: 10px;
    }

    .header-right h1 {
      font-family: 'Expletus Sans', sans-serif;
      font-weight: 600;
      font-size: 1.25rem;
      /* Ajusta el tamaño de la fuente según sea necesario */
    }

    .relative h1{
      font-family: 'Expletus Sans', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-900">
  <div class="bg-image"></div>
  <div class="bg-image-overlay">
    <!-- Icono y texto en la parte superior derecha -->
    <div class="header-right">
      <img src="<?php echo base_url('img/logoCubo.png'); ?>" alt="Icono">
      <h1>DigiManager</h1>
    </div>

    <img src="<?php echo base_url('img/eks.png'); ?>" alt="Logo" class="logo">

    <div class="relative z-10 max-w-md w-full bg-white rounded-lg shadow-lg p-8">
      <h1 class="text-3xl font-semibold text-center mb-6">Inicio de Sesión</h1>
      
      <!-- Mensajes de error -->
      <?php if(session()->getFlashdata('error')): ?>
        <div class="text-red-600 text-center mb-4">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
      
      <form action="<?php echo base_url('/login') ?>" method="POST" class="space-y-4">
        <div>
          <label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
          <input type="text" name="usuario" id="usuario" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
          <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Acceder</button>
        <div class="text-center mt-4">
          <a href="/forgot-password" class="text-green-600 hover:text-green-700 text-sm">¿Olvidaste tu contraseña?</a>
        </div>
      </form>
      <div class="text-center mt-6">
        <p class="text-gray-600 text-sm">Sistema de Gestión de Proyectos</p>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>

</html>
