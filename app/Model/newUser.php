<?php
require_once "../config/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y limpiar datos
    $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING);
    $usuario = filter_var(trim($_POST['usuario']), FILTER_SANITIZE_STRING);
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $telefono = filter_var(trim($_POST['telefono']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $rol = filter_var(trim($_POST['rol']), FILTER_SANITIZE_STRING);

    // Validar campos requeridos
    if (empty($nombre) || empty($usuario) || empty($correo) || empty($password)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos son requeridos'
            });
        </script>";
        exit;
    }

    // Verificar si el usuario ya existe
    $check_query = "SELECT * FROM usuario WHERE usuario = ? OR correo = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bind_param("ss", $usuario, $correo);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El usuario o correo ya existe'
            });
        </script>";
        exit;
    }

    // Cifrar contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO usuario (nombre, usuario, correo, telefono, password, rol) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $usuario, $correo, $telefono, $hashed_password, $rol);

    if ($stmt->execute()) {
        echo "<script>
                alert('Usuario registrado correctamente');
                window.location.href = '../Views/usuario.php';
            </script>";
    } else {
        echo "<script>
                alert('Usuario no registrado correctamente');
                window.location.href = '../Views/usuario.php';
            </script>";
    }

    $stmt->close();
    $connect->close();
}
?>
