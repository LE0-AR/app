<?php
include_once('../config/conexion.php'); // Verifica la ruta correcta de la conexión
include("../formulario.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $sector = $_POST['sector'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    // Ruta para subir archivos
    $upload_dir = "img/";
    $FichaTe = "Ficha/";

    // Crear la carpeta 'uploads' si no existe
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Manejo de imagen principal
    $imagen_principal = null;
    if (!empty($_FILES['imagen_principal']['name'])) {
        $imagen_principal = $upload_dir . basename($_FILES['imagen_principal']['name']);
        if (!move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $imagen_principal)) {
            die("Error al subir la imagen principal.");
        }
    }

    // Manejo de ficha técnica
    $ficha_tecnica = null;
    if (!empty($_FILES['ficha_tecnica']['name'])) {
        $ficha_tecnica = $FichaTe . basename($_FILES['ficha_tecnica']['name']);
        if (!move_uploaded_file($_FILES['ficha_tecnica']['tmp_name'], $ficha_tecnica)) {
            die("Error al subir la ficha técnica.");
        }
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO productos (nombre, sector, categoria, imagen_principal, descripcion, ficha_tecnica) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $sector, $categoria, $imagen_principal, $descripcion, $ficha_tecnica);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Producto guardado correctamente.');
                window.location = '../index.php'; 
              </script>";
    } else {
        echo "<script>alert('Error al guardar el producto.');</script>";
    }

    mysqli_close($connect);
}
?>
