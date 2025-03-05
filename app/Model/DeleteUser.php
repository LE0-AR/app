<?php
include "../config/conexion.php";

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Eliminar usuario usando consulta preparada
    $sql = "DELETE FROM usuario WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>
            alert('Usuario eliminado correctamente');
            window.location.href = '../Views/usuario.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al eliminar el usuario');
            window.location.href = '../Views/usuario.php';
        </script>";
    }

    $stmt->close();
    $connect->close();
} else {
    echo "<script>
        alert('ID de usuario no proporcionado');
        window.location.href = '../Views/usuario.php';
    </script>";
}
?>