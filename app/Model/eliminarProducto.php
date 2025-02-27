<?php
include "../config/conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM productos WHERE id='$id'";
    $connect->query($sql);
    
    $sql_car = "DELETE FROM caracteristicas WHERE producto_id='$id'";
    $connect->query($sql_car);
    
    $sql_esp = "DELETE FROM especificaciones_tecnicas WHERE producto_id='$id'";
    $connect->query($sql_esp);
    
    header("Location: ../Views/formulario.php");
}
?>
