<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Permisos del Usuario</title>
    <style>
        .parent-permission {
            font-weight: bold;
        }
        .child-permission {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h2>Administrar Permisos para el Usuario ID: <?= $usuarioId ?></h2>

    <form action="/permisos/updatePermisos" method="post">
        <input type="hidden" name="usuario_id" value="<?= $usuarioId ?>">

        <!-- Gestión de Proyectos -->
        <div>
            <label class="parent-permission">
                <input type="checkbox" id="gestionar_proyectos" onclick="toggleChildren('proyectos', this.checked)">
                Gestionar Proyectos
            </label>
            <div class="child-permission">
                <label><input type="checkbox" name="permisos[crear_proyecto]" value="1" class="proyectos"> Crear Proyecto</label>
                <label><input type="checkbox" name="permisos[ver_proyecto]" value="1" class="proyectos"> Ver Proyecto</label>
                <label><input type="checkbox" name="permisos[editar_proyecto]" value="1" class="proyectos"> Editar Proyecto</label>
                <label><input type="checkbox" name="permisos[eliminar_proyecto]" value="1" class="proyectos"> Eliminar Proyecto</label>
                <label><input type="checkbox" name="permisos[exportar_proyecto]" value="1" class="proyectos"> Exportar Proyecto</label>
            </div>
        </div>

        <!-- Gestión de Usuarios -->
        <div>
            <label class="parent-permission">
                <input type="checkbox" id="gestionar_usuarios" onclick="toggleChildren('usuarios', this.checked)">
                Gestionar Usuarios
            </label>
            <div class="child-permission">
                <label><input type="checkbox" name="permisos[crear_usuario]" value="1" class="usuarios"> Crear Usuario</label>
                <label><input type="checkbox" name="permisos[ver_usuario]" value="1" class="usuarios"> Ver Usuario</label>
                <label><input type="checkbox" name="permisos[editar_usuario]" value="1" class="usuarios"> Editar Usuario</label>
                <label><input type="checkbox" name="permisos[eliminar_usuario]" value="1" class="usuarios"> Eliminar Usuario</label>
            </div>
        </div>

        <!-- Gestión de Clientes -->
        <div>
            <label class="parent-permission">
                <input type="checkbox" id="gestionar_clientes" onclick="toggleChildren('clientes', this.checked)">
                Gestionar Clientes
            </label>
            <div class="child-permission">
                <label><input type="checkbox" name="permisos[crear_cliente]" value="1" class="clientes"> Crear Cliente</label>
                <label><input type="checkbox" name="permisos[ver_cliente]" value="1" class="clientes"> Ver Cliente</label>
                <label><input type="checkbox" name="permisos[editar_cliente]" value="1" class="clientes"> Editar Cliente</label>
                <label><input type="checkbox" name="permisos[eliminar_cliente]" value="1" class="clientes"> Eliminar Cliente</label>
            </div>
        </div>

        <!-- Similar structure for "Gestionar Tareas", "Gestionar Recursos", etc. -->

        <button type="submit">Guardar Cambios</button>
    </form>

    <script>
        function toggleChildren(className, isChecked) {
            const checkboxes = document.querySelectorAll(`.${className}`);
            checkboxes.forEach(checkbox => checkbox.checked = isChecked);
        }
    </script>
</body>
</html>
