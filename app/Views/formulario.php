<?php
    require_once "../config/app.php"; 
    include_once "../public/autoload/head.php";
    include_once "../config/conexion.php";
    include_once "../config/sesion_Ini.php";    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../public/css/table.css">
</head>
<style>
     .img img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
</style>
<body>
   
<?php
    include_once "../public/autoload/header.php";
    include_once "../Control/ProductList.php";
?>


</body>
</html>