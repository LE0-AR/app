

<?php
include "../../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $sector = $_POST['sector'];
    $descripcion = $_POST['descripcion'];

    // Base path for file uploads
    $base_path = "../../Control/";

    // Manejo de archivos (Imagen principal y Ficha Técnica)
    $imagen_principal = "";
    if (!empty($_FILES['imagen_principal']['name'])) {
        $imagen_principal = "img/" . basename($_FILES['imagen_principal']['name']);
        move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $base_path . $imagen_principal);
    }

    $ficha_tecnica = "";
    if (!empty($_FILES['ficha_tecnica']['name'])) {
        $ficha_tecnica = "Ficha/" . basename($_FILES['ficha_tecnica']['name']);
        move_uploaded_file($_FILES['ficha_tecnica']['tmp_name'], $base_path . $ficha_tecnica);
    }

    // Insertar en la tabla productos
    $sql = "INSERT INTO productos (nombre, sector, categoria, descripcion, imagen_principal, ficha_tecnica)
            VALUES ('$nombre', '$sector', '$categoria', '$descripcion', '$imagen_principal', '$ficha_tecnica')";

    if ($connect->query($sql) === TRUE) {
        $producto_id = $connect->insert_id; // Obtener el ID del producto insertado

        // Insertar características
        if (!empty($_POST['caracteristica_titulo']) && !empty($_POST['caracteristica_descripcion'])) {
            foreach ($_POST['caracteristica_titulo'] as $index => $titulo) {
                $descripcion_caracteristica = $_POST['caracteristica_descripcion'][$index];
                $sql_caracteristica = "INSERT INTO caracteristicas (producto_id, titulo, descripcion) 
                                       VALUES ('$producto_id', '$titulo', '$descripcion_caracteristica')";
                $connect->query($sql_caracteristica);
            }
        }

        // Insertar especificaciones técnicas
        if (!empty($_POST['especificacion_titulo']) && !empty($_POST['especificacion_descripcion'])) {
            foreach ($_POST['especificacion_titulo'] as $index => $titulo) {
                $valor = $_POST['especificacion_descripcion'][$index];
                $sql_especificacion = "INSERT INTO especificaciones_tecnicas (producto_id, titulo, descripcion) 
                                       VALUES ('$producto_id', '$titulo', '$valor')";
                $connect->query($sql_especificacion);
            }
        }

        // Subir imágenes secundarias
        if (!empty($_FILES['imagenes_secundarias']['name'][0])) {
            foreach ($_FILES['imagenes_secundarias']['tmp_name'] as $key => $tmp_name) {
                $imagen_secundaria = "img/" . basename($_FILES['imagenes_secundarias']['name'][$key]);
                move_uploaded_file($_FILES['imagenes_secundarias']['tmp_name'][$key], $base_path . $imagen_secundaria);

                // Insertar en la tabla imagenes_secundarias
                $sql_imagen = "INSERT INTO imagenes_secundarias (producto_id, imagen_url) 
                               VALUES ('$producto_id', '$imagen_secundaria')";
                $connect->query($sql_imagen);
            }
        }

      
        echo "<script>alert('Producto registrado correctamente'); window.location.href = '../../Views/user/';</script>";
    } else {
        echo "<script>alert('Error al registrar el producto'); window.location.href = '../../Views/user/';</script>";
    }

    $connect->close(); // Cerrar conexión
}
?>