<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuario WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado";
        exit();
    }
}
?>

<div class="container">
    <br>
    <center><h2 class="titlePrin">Editar datos del usuario</h2></center>
    <br>
    <form method="POST" action="<?php echo APP_URL; ?>/app/Model/EditUser.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre y apellido:</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="usuario">Nombre del usuario:</label>
                <input type="text" class="form-control" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" class="form-control" name="correo" value="<?php echo $usuario['correo']; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="telefono">Número de teléfono:</label>
                <input type="number" class="form-control" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" name="password" placeholder="Dejar en blanco para mantener la actual">
                <small class="form-text text-muted">Solo llene este campo si desea cambiar la contraseña</small>
            </div>
            <div class="form-group col-md-6">
                <label for="rol">Rol del Usuario</label>
                <select class="form-control" name="rol" required>
                    <option value="Admin" <?php echo ($usuario['rol'] == 'Admin') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="User" <?php echo ($usuario['rol'] == 'User') ? 'selected' : ''; ?>>Usuario</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-primary">Actualizar Usuario</button>
        <a href="<?php echo APP_URL; ?>/app/Views/usuario.php" class="btn btn-outline-secondary">Cancelar</a>
    </form>
    <br>
</div>