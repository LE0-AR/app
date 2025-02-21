<?php
include "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $sector = $_POST['sector'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    // Subir imagen principal
    $imagen_principal = "";
    if (!empty($_FILES['imagen_principal']['name'])) {
        $imagen_principal = "Control/img/" . basename($_FILES['imagen_principal']['name']);
        move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $imagen_principal);
    }

    // Subir ficha técnica
    $ficha_tecnica = "";
    if (!empty($_FILES['ficha_tecnica']['name'])) {
        $ficha_tecnica = "Control/Ficha/" . basename($_FILES['ficha_tecnica']['name']);
        move_uploaded_file($_FILES['ficha_tecnica']['tmp_name'], $ficha_tecnica);
    }

    // Insertar en la tabla productos
    $sql = "INSERT INTO productos (nombre, sector, categoria, descripcion, imagen_principal, ficha_tecnica)
            VALUES ('$nombre', '$sector', '$categoria', '$descripcion', '$imagen_principal', '$ficha_tecnica')";
    
    if ($connect->query($sql) === TRUE) {
        $producto_id = $connect->insert_id;

        // Insertar características
        if (!empty($_POST['caracteristica_titulo']) && !empty($_POST['caracteristica_descripcion'])) {
            $caracteristica_titulo = $_POST['caracteristica_titulo'];
            $caracteristica_descripcion = $_POST['caracteristica_descripcion'];
            $sql_caracteristica = "INSERT INTO caracteristicas (producto_id, titulo, descripcion) 
                                   VALUES ('$producto_id', '$caracteristica_titulo', '$caracteristica_descripcion')";
            $connect->query($sql_caracteristica);
        }

        // Insertar especificaciones técnicas
        if (!empty($_POST['especificacion_titulo']) && !empty($_POST['especificacion_valor'])) {
            $especificacion_titulo = $_POST['especificacion_titulo'];
            $especificacion_valor = $_POST['especificacion_valor'];
            $sql_especificacion = "INSERT INTO especificaciones_tecnicas (producto_id, especificacion, valor) 
                                   VALUES ('$producto_id', '$especificacion_titulo', '$especificacion_valor')";
            $connect->query($sql_especificacion);
        }

        // Subir imágenes secundarias
        if (!empty($_FILES['imagenes_secundarias']['name'][0])) {
            foreach ($_FILES['imagenes_secundarias']['tmp_name'] as $key => $tmp_name) {
                $imagen_secundaria = "Control/img/" . basename($_FILES['imagenes_secundarias']['name'][$key]);
                move_uploaded_file($_FILES['imagenes_secundarias']['tmp_name'][$key], $imagen_secundaria);

                // Guardar en la tabla imagenes_secundarias
                $sql_imagen = "INSERT INTO imagenes_secundarias (producto_id, imagen_url) 
                               VALUES ('$producto_id', '$imagen_secundaria')";
                $connect->query($sql_imagen);
            }
        }

        echo "<script>alert('Producto registrado correctamente');</script>";
    } else {
        echo "<script>alert('Error al registrar el producto');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Producto</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; }
        input, textarea, select { width: 100%; padding: 8px; margin: 5px 0; }
        button { padding: 10px; background: blue; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <h2>Registro de Producto</h2>
    <form action="formulario.php" method="POST" enctype="multipart/form-data">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Sector:</label>
        <input type="text" name="sector" required>

        <label>Categoría:</label>
        <input type="text" name="categoria" required>

        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <label>Imagen Principal:</label>
        <input type="file" name="imagen_principal" accept="image/*" required>

        <label>Ficha Técnica (PDF):</label>
        <input type="file" name="ficha_tecnica" accept=".pdf">

        <h3>Características</h3>
        <label>Título:</label>
        <input type="text" name="caracteristica_titulo">
        <label>Descripción:</label>
        <textarea name="caracteristica_descripcion"></textarea>

        <h3>Especificaciones Técnicas</h3>
        <label>Especificación:</label>
        <input type="text" name="especificacion_titulo">
        <label>Valor:</label>
        <input type="text" name="especificacion_valor">

        <h3>Imágenes Secundarias</h3>
        <label>Selecciona múltiples imágenes:</label>
        <input type="file" name="imagenes_secundarias[]" accept="image/*" multiple>

        <button type="submit">Guardar Producto</button>
    </form>
</div>

</body>
</html>
