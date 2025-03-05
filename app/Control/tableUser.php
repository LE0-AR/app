<?php

if ($connect->connect_error) {
    die("Conexión fallida: " . $connect->connect_error);
}

// Consulta SQL para obtener los usuarios
$sql = "SELECT * FROM usuario";
$result = $connect->query($sql);

?>

<div class="container">
    <h1 class="titulo">Tabla de Usuarios</h1>

    <div class="newProduct">
        <a type="button" class="btn btn-outline-primary" href="../Views/newUser.php">Nuevo Usuario</a>
    </div>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Rol</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                    <td><?php echo htmlspecialchars($row['correo']); ?></td>
                    <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td>
                        <?php 
                            echo ($row['rol'] === 'Admin') ? 'Administrador' : 'Usuario';
                        ?>
                    </td>
                    <td>
                        <a href="../Views/editUser.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-warning">Editar</a>
                        <a href="../Model/DeleteUser.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
