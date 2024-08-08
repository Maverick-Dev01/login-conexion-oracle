<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
        <?php if (!empty($usuarios) && is_array($usuarios)) : ?>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['NOMBRE']; ?></td>
                <td><?php echo $usuario['EMAIL']; ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="3">No se encontraron usuarios.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
