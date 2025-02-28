<?php
include "../config/conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar características del producto
    $sql_caracteristicas = "DELETE FROM caracteristicas WHERE producto_id='$id'";
    $connect->query($sql_caracteristicas);

    // Eliminar especificaciones técnicas del producto
    $sql_especificaciones = "DELETE FROM especificaciones_tecnicas WHERE producto_id='$id'";
    $connect->query($sql_especificaciones);

    // Eliminar el producto
    $sql_producto = "DELETE FROM productos WHERE id='$id'";
    if ($connect->query($sql_producto) === TRUE) {
        echo "<script>alert('Producto eliminado correctamente'); window.location.href = '../Views/formulario.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto'); window.location.href = '../Views/formulario.php';</script>";
    }

    $connect->close(); // Cerrar conexión
} else {
    echo "<script>alert('ID de producto no proporcionado'); window.location.href = '../Views/formulario.php';</script>";
}
?>