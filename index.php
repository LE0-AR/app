<?php
    require_once "app/config/app.php"; 
    include_once "app/config/conexion.php";
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="app/public/css/login.css">
    <!-- SweetAlert2 CSS  $2y$10$EEgML5QOejphe8s6TgHCkex4xB1pt9js4PrjAl9j0.X1/Q3I1fnbO -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    
    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "> </script>
    <?php include_once "app/public/autoload/head.php"; ?>
</head>
<body>
<?php
    include_once "app/Views/login.php";
    include_once "app/Control/Ajax/Validar.php";
?>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
 <script src="app/public/js/form.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>