<?php 
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: ../");
    exit(); 
}

// Validación adicional por rol
if(isset($_SESSION['rol'])) {
    $ruta_actual = $_SERVER['PHP_SELF'];
    
    // Si es usuario normal intentando acceder a área de admin
    if($_SESSION['rol'] == 'User' && strpos($ruta_actual, '/Admin/') !== false) {
        header("Location: ../Views/user/");
        exit();
    }
}
?>