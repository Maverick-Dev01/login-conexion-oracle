<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Permisos del Usuario</title>
    <!-- Incluye el enlace a Tailwind CSS -->
   
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/patterns.css'); ?>">

</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-6">Administrar Permisos para el Usuario ID: <span class="text-blue-500"><?= $usuarioId ?></span></h2>

        <form action="/permisos/updatePermisos" method="post" class="space-y-4">
            <input type="hidden" name="usuario_id" value="<?= $usuarioId ?>">

            <!-- Gestión de Proyectos -->
            <div class="border-t pt-4">
                <label class="flex items-center space-x-2 font-semibold text-gray-700">
                    <input type="checkbox" id="gestionar_proyectos" onclick="toggleChildren('proyectos', this.checked)" class="form-checkbox">
                    <span>Gestionar Proyectos</span>
                </label>
                <div class="ml-6 grid grid-cols-2 gap-4">
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[ver_proyecto]" value="1" class="form-checkbox proyectos"> <span>Ver Proyecto</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[editar_proyecto]" value="1" class="form-checkbox proyectos"> <span>Editar Proyecto</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[eliminar_proyecto]" value="1" class="form-checkbox proyectos"> <span>Eliminar Proyecto</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[exportar_proyecto]" value="1" class="form-checkbox proyectos"> <span>Exportar Tabla</span></label>
                </div>
            </div>

            <!-- Gestión de Usuarios -->
            <div class="border-t pt-4">
                <label class="flex items-center space-x-2 font-semibold text-gray-700">
                    <input type="checkbox" id="gestionar_usuarios" onclick="toggleChildren('usuarios', this.checked)" class="form-checkbox">
                    <span>Gestionar Usuarios</span>
                </label>
                <div class="ml-6 grid grid-cols-2 gap-4">
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[crear_usuario]" value="1" class="form-checkbox usuarios"> <span>Crear Usuario</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[ver_usuario]" value="1" class="form-checkbox usuarios"> <span>Ver Usuario</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[editar_usuario]" value="1" class="form-checkbox usuarios"> <span>Editar Usuario</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[eliminar_usuario]" value="1" class="form-checkbox usuarios"> <span>Eliminar Usuario</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[exportar_usuario]" value="1" class="form-checkbox usuarios"> <span>Exportar Tabla</span></label>
                </div>
            </div>

            <!-- Gestión de Clientes -->
            <div class="border-t pt-4">
                <label class="flex items-center space-x-2 font-semibold text-gray-700">
                    <input type="checkbox" id="gestionar_clientes" onclick="toggleChildren('clientes', this.checked)" class="form-checkbox">
                    <span>Gestionar Clientes</span>
                </label>
                <div class="ml-6 grid grid-cols-2 gap-4">
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[crear_cliente]" value="1" class="form-checkbox clientes"> <span>Crear Cliente</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[ver_cliente]" value="1" class="form-checkbox clientes"> <span>Ver Cliente</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[editar_cliente]" value="1" class="form-checkbox clientes"> <span>Editar Cliente</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[eliminar_cliente]" value="1" class="form-checkbox clientes"> <span>Eliminar Cliente</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[exportar_cliente]" value="1" class="form-checkbox clientes"> <span>Exportar Tabla</span></label>
                </div>
            </div>

            <!-- Gestión de Tareas -->
            <div class="border-t pt-4">
                <label class="flex items-center space-x-2 font-semibold text-gray-700">
                    <input type="checkbox" id="gestionar_tareas" onclick="toggleChildren('tareas', this.checked)" class="form-checkbox">
                    <span>Gestionar Tareas</span>
                </label>
                <div class="ml-6 grid grid-cols-2 gap-4">
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[crear_tarea]" value="1" class="form-checkbox tareas"> <span>Crear Tareas</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[ver_tarea]" value="1" class="form-checkbox tareas"> <span>Ver Tareas</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[editar_tarea]" value="1" class="form-checkbox tareas"> <span>Editar Tareas</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[eliminar_tarea]" value="1" class="form-checkbox tareas"> <span>Eliminar Tareas</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[exportar_tarea]" value="1" class="form-checkbox tareas"> <span>Exportar Tabla</span></label>
                </div>
            </div>

            <!-- Gestión de Recursos -->
            <div class="border-t pt-4">
                <label class="flex items-center space-x-2 font-semibold text-gray-700">
                    <input type="checkbox" id="gestionar_recursos" onclick="toggleChildren('recursos', this.checked)" class="form-checkbox">
                    <span>Gestionar Recursos</span>
                </label>
                <div class="ml-6 grid grid-cols-2 gap-4">
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[crear_recurso]" value="1" class="form-checkbox recursos"> <span>Crear Recursos</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[ver_recurso]" value="1" class="form-checkbox recursos"> <span>Ver Recursos</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[editar_recurso]" value="1" class="form-checkbox recursos"> <span>Editar Recursos</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[eliminar_recurso]" value="1" class="form-checkbox recursos"> <span>Eliminar Recursos</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[exportar_recurso]" value="1" class="form-checkbox recursos"> <span>Exportar Tabla</span></label>
                </div>
            </div>

            <!-- Gestión de Reuniones -->
            <div class="border-t pt-4">
                <label class="flex items-center space-x-2 font-semibold text-gray-700">
                    <input type="checkbox" id="gestionar_reuniones" onclick="toggleChildren('reuniones', this.checked)" class="form-checkbox">
                    <span>Gestionar Reuniones</span>
                </label>
                <div class="ml-6 grid grid-cols-2 gap-4">
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[crear_reunion]" value="1" class="form-checkbox reuniones"> <span>Crear Reuniones</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[ver_reunion]" value="1" class="form-checkbox reuniones"> <span>Ver Reuniones</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[editar_reunion]" value="1" class="form-checkbox reuniones"> <span>Editar Reuniones</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[eliminar_reunion]" value="1" class="form-checkbox reuniones"> <span>Eliminar Reuniones</span></label>
                    <label class="flex items-center space-x-2 text-gray-600"><input type="checkbox" name="permisos[exportar_reunion]" value="1" class="form-checkbox reuniones"> <span>Exportar Tabla</span></label>
                </div>
            </div>

            <!-- Gestión de Gráficas -->
            <div class="border-t pt-4">
                <label class="flex items-center space-x-2 font-semibold text-gray-700">
                    <input type="checkbox" id="gestionar_graficas" onclick="toggleChildren('graficas', this.checked)" class="form-checkbox">
                    <span>Gestionar Gráficas</span>
                </label>
            </div>

            <!-- Botones de acción -->
            <div class="pt-6 flex justify-end space-x-4">
                <button type="button" class="py-2 px-4 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 focus:outline-none">
                <a href="<?php echo base_url('/permisos'); ?>" class="text-white-500 focus:outline-none mr-2">
                Cancelar
                </button>
                <button type="submit" class="py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleChildren(className, isChecked) {
            const checkboxes = document.querySelectorAll(`.${className}`);
            checkboxes.forEach(checkbox => checkbox.checked = isChecked);
        }
    </script>
</body>

</html>
