<?php
include "./config/conexion.php";
require_once "config/app.php";
include_once "public/autoload/head.php";
// Consulta para contar los productos
$sql_productos = "SELECT COUNT(*) AS total FROM productos";
$result_productos = $connect->query($sql_productos);
$total_productos = ($result_productos->num_rows > 0) ? $result_productos->fetch_assoc()['total'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/home.css">
</head>

<body>

    <?php
    include_once "public/autoload/header.php";

    ?>
  <div class="containerHome">
        <h1>Inicio</h1>
        <div class="dashboard">
            <div class="card"> <!--onclick="location.href='usuarios.php'"-->
                <i class="fas fa-user icon"></i>
                <p class="title">USUARIOS</p>
                <p class="count">0</p>
            </div>
            <div class="card" onclick="location.href='./Views/formulario.php'">
                <i class="fas fa-box icon"></i>
                <p class="title">PRODUCTOS</p>
                <p class="count"><?php echo $total_productos; ?></p>
            </div>
        </div>
    </div>
</body>

</html>