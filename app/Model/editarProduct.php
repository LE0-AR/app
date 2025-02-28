<?php
include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $sector = $_POST['sector'];
    $descripcion = $_POST['descripcion'];

    // Manejo de archivos (Imagen principal y Ficha Técnica)
    $imagen_principal = $_POST['imagen_principal_actual'];
    if (!empty($_FILES['imagen_principal']['name'])) {
        $imagen_principal = "img/" . basename($_FILES['imagen_principal']['name']);
        move_uploaded_file($_FILES['imagen_principal']['tmp_name'], "../Control/" . $imagen_principal);
    }

    $ficha_tecnica = $_POST['ficha_tecnica_actual'];
    if (!empty($_FILES['ficha_tecnica']['name'])) {
        $ficha_tecnica = "Ficha/" . basename($_FILES['ficha_tecnica']['name']);
        move_uploaded_file($_FILES['ficha_tecnica']['tmp_name'], "../Control/" . $ficha_tecnica);
    }

    // Actualizar tabla productos
    $sql = "UPDATE productos SET nombre='$nombre', categoria='$categoria', sector='$sector', descripcion='$descripcion', imagen_principal='$imagen_principal', ficha_tecnica='$ficha_tecnica' WHERE id='$id'";
    if ($connect->query($sql) === TRUE) {
        // Actualizar características
        if (!empty($_POST['caracteristica_titulo']) && !empty($_POST['caracteristica_descripcion'])) {
            foreach ($_POST['caracteristica_titulo'] as $index => $titulo) {
                $descripcion_car = $_POST['caracteristica_descripcion'][$index];
                $sql_car = "UPDATE caracteristicas SET titulo='$titulo', descripcion='$descripcion_car' WHERE producto_id='$id' AND id='$index'";
                $connect->query($sql_car);
            }
        }

        // Actualizar especificaciones técnicas
        if (!empty($_POST['especificacion_titulo']) && !empty($_POST['especificacion_Descripcion'])) {
            foreach ($_POST['especificacion_titulo'] as $index => $titulo) {
                $valor = $_POST['especificacion_Descripcion'][$index];
                $sql_esp = "UPDATE especificaciones_tecnicas SET titulo='$titulo', descripcion='$valor' WHERE producto_id='$id' AND id='$index'";
                $connect->query($sql_esp);
            }
        }

        echo "<script>alert('Producto actualizado correctamente'); window.location.href = '../Views/formulario.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el producto'); window.location.href = '../Views/formulario.php';</script>";
    }

    $connect->close(); // Cerrar conexión
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM productos WHERE id='$id'";
        $result = $connect->query($sql);
        $producto = $result->fetch_assoc();
    }
}
?>