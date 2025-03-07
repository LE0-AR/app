<?php
include "./config/conexion.php";
require_once "config/app.php";
include_once "public/autoload/head.php";
include_once "config/sesion_Ini.php";

// Validar rol y redirigir
if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'User') {
    header("Location: Views/user/");
    exit();
}

// Consultas solo si es administrador
$sql_productos = "SELECT COUNT(*) AS total FROM productos";
$result_productos = $connect->query($sql_productos);
$total_productos = ($result_productos->num_rows > 0) ? $result_productos->fetch_assoc()['total'] : 0;

$sql_usuarios = "SELECT COUNT(*) AS total FROM usuario";
$result_usuarios = $connect->query($sql_usuarios);
$total_usuarios = ($result_usuarios->num_rows > 0) ? $result_usuarios->fetch_assoc()['total'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/home.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<?php include_once "public/autoload/header.php"; ?>
    <div class="containerHome">
        <h1>Panel de Administración</h1>
        <div class="dashboard">
            <div class="card" onclick="location.href='./Views/usuario.php'">
                <i class="fas fa-user icon"></i>
                <p class="title">USUARIOS</p>
                <p class="count"><?php echo $total_usuarios?></p>
            </div>
            <div class="card" onclick="location.href='./Views/formulario.php'">
                <i class="fas fa-box icon"></i>
                <p class="title">PRODUCTOS</p>
                <p class="count"><?php echo $total_productos; ?></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>