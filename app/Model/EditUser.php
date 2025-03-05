<?php
require_once "../config/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING);
    $usuario = filter_var(trim($_POST['usuario']), FILTER_SANITIZE_STRING);
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $telefono = filter_var(trim($_POST['telefono']), FILTER_SANITIZE_STRING);
    $rol = filter_var(trim($_POST['rol']), FILTER_SANITIZE_STRING);
    $password = trim($_POST['password']);

    try {
        if (!empty($password)) {
            // Si se proporcionó una nueva contraseña, actualizarla también
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET 
                    nombre = ?, 
                    usuario = ?, 
                    correo = ?, 
                    telefono = ?, 
                    password = ?,
                    rol = ? 
                    WHERE id = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("ssssssi", $nombre, $usuario, $correo, $telefono, $hashed_password, $rol, $id);
        } else {
            // Si no hay nueva contraseña, actualizar todo excepto la contraseña
            $sql = "UPDATE usuario SET 
                    nombre = ?, 
                    usuario = ?, 
                    correo = ?, 
                    telefono = ?, 
                    rol = ? 
                    WHERE id = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("sssssi", $nombre, $usuario, $correo, $telefono, $rol, $id);
        }

        if ($stmt->execute()) {
            echo "<script>
                alert('Usuario actualizado correctamente');
                window.location.href = '../Views/usuario.php';
            </script>";
        } else {
            echo "<script>
                alert('Error: No se pudo actualizar el usuario');
                history.back();
            </script>";
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "<script>
            alert('Error en la base de datos: " . $e->getMessage() . "');
            history.back();
        </script>";
    }

    $connect->close();
}
?>