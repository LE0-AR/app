<?php
include "../../config/conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $sector = $_POST['sector'];
    $descripcion = $_POST['descripcion'];

    // Manejo de archivos (Imagen principal y Ficha Técnica)
    $imagen_principal = $_POST['imagen_principal_actual'];
    if (!empty($_FILES['imagen_principal']['name'])) {
        $imagen_principal = "img/" . basename($_FILES['imagen_principal']['name']);
        move_uploaded_file($_FILES['imagen_principal']['tmp_name'], "../Control/" . $imagen_principal);
    }

    $ficha_tecnica = $_POST['ficha_tecnica_actual'];
    if (!empty($_FILES['ficha_tecnica']['name'])) {
        $ficha_tecnica = "Ficha/" . basename($_FILES['ficha_tecnica']['name']);
        move_uploaded_file($_FILES['ficha_tecnica']['tmp_name'], "../Control/" . $ficha_tecnica);
    }

    // Actualizar tabla productos
    $sql = "UPDATE productos SET nombre='$nombre', categoria='$categoria', sector='$sector', 
            descripcion='$descripcion', imagen_principal='$imagen_principal', 
            ficha_tecnica='$ficha_tecnica' WHERE id='$id'";

    if ($connect->query($sql) === TRUE) {
        // Primero eliminar características existentes
        $sql_delete_car = "DELETE FROM caracteristicas WHERE producto_id='$id'";
        $connect->query($sql_delete_car);

        // Insertar nuevas características
        if (!empty($_POST['caracteristica_titulo']) && !empty($_POST['caracteristica_descripcion'])) {
            foreach ($_POST['caracteristica_titulo'] as $index => $titulo) {
                $descripcion_car = $_POST['caracteristica_descripcion'][$index];
                $sql_car = "INSERT INTO caracteristicas (producto_id, titulo, descripcion) 
                           VALUES ('$id', '$titulo', '$descripcion_car')";
                $connect->query($sql_car);
            }
        }

        // Eliminar especificaciones técnicas existentes
        $sql_delete_esp = "DELETE FROM especificaciones_tecnicas WHERE producto_id='$id'";
        $connect->query($sql_delete_esp);

        // Insertar nuevas especificaciones técnicas
        if (!empty($_POST['especificacion_titulo']) && !empty($_POST['especificacion_descripcion'])) {
            foreach ($_POST['especificacion_titulo'] as $index => $titulo) {
                $descripcion_esp = $_POST['especificacion_descripcion'][$index];
                $sql_esp = "INSERT INTO especificaciones_tecnicas (producto_id, titulo, descripcion) 
                           VALUES ('$id', '$titulo', '$descripcion_esp')";
                $connect->query($sql_esp);
            }
        }

        // Manejo de imágenes secundarias
        if (!empty($_FILES['imagenes_secundarias']['name'][0])) {
            // Eliminar imágenes secundarias actuales
            $sql_delete_imagenes = "DELETE FROM imagenes_secundarias WHERE producto_id='$id'";
            $connect->query($sql_delete_imagenes);

            // Subir nuevas imágenes secundarias
            foreach ($_FILES['imagenes_secundarias']['name'] as $key => $value) {
                $imagen_secundaria = "img/" . basename($_FILES['imagenes_secundarias']['name'][$key]);
                move_uploaded_file($_FILES['imagenes_secundarias']['tmp_name'][$key], "../Control/" . $imagen_secundaria);

                $sql_imagen = "INSERT INTO imagenes_secundarias (producto_id, imagen_url) 
                              VALUES ('$id', '$imagen_secundaria')";
                $connect->query($sql_imagen);
            }
        }

        echo "<script>
            alert('Producto actualizado correctamente');
            window.location.href = '../../Views/user/ProductUser.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al actualizar el producto: " . $connect->error . "');
            window.location.href = '../../Views/user/ProductUser.php';
        </script>";
    }

    $connect->close();
}
?>