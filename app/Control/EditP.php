<?php
include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $sector = $_POST['sector'];
    $descripcion = $_POST['descripcion'];

    // Actualizar tabla productos
    $sql = "UPDATE productos SET nombre='$nombre', categoria='$categoria', sector='$sector', descripcion='$descripcion' WHERE id='$id'";
    if ($connect->query($sql) === TRUE) {
        // Actualizar características
        if (!empty($_POST['caracteristica_titulo']) && !empty($_POST['caracteristica_descripcion'])) {
            foreach ($_POST['caracteristica_titulo'] as $index => $titulo) {
                $descripcion_car = $_POST['caracteristica_descripcion'][$index];
                $sql_car = "UPDATE caracteristicas SET titulo='$titulo', descripcion='$descripcion_car' WHERE producto_id='$id' AND id='$index'";
                $connect->query($sql_car);
            }
        }

        // Actualizar especificaciones técnicas
        if (!empty($_POST['especificacion_titulo']) && !empty($_POST['especificacion_Descripcion'])) {
            foreach ($_POST['especificacion_titulo'] as $index => $titulo) {
                $valor = $_POST['especificacion_Descripcion'][$index];
                $sql_esp = "UPDATE especificaciones_tecnicas SET titulo='$titulo', descripcion='$valor' WHERE producto_id='$id' AND id='$index'";
                $connect->query($sql_esp);
            }
        }

        header("Location: ../Views/formulario.php");
    } else {
        echo "Error al actualizar: " . $connect->error;
    }

    $connect->close(); // Cerrar conexión
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM productos WHERE id='$id'";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
        } else {
            echo "Producto no encontrado";
            exit();
        }
    }
}
$base_url = "http://localhost/app/app/";
?>

<!-- Formulario de edición -->
<form method="POST" action="../Control/EditP.php">
    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required />
    <label>Categoría:</label>
    <input type="text" name="categoria" value="<?php echo $producto['categoria']; ?>" required />
    <label>Sector:</label>
    <input type="text" name="sector" value="<?php echo $producto['sector']; ?>" required />
    <label>Descripción:</label>
    <input type="text" name="sector" value="<?php echo $producto['sector']; ?>" required />
    <img src="" alt="">
    <label>Imagen:</label>
    <img src="<?php echo  $base_url . 'Control/'. $producto['imagen_principal']; ?>" alt="">
    <label >¿Deseas editar la imagen?</label>
    <input type="checkbox" id="cbox2" value="second_checkbox"/>
    <label>Ficha Técnica:</label>
    <a href="<?php echo  $base_url . 'Control/'. $producto['ficha_tecnica'];?>" target="_blank">Ver Ficha</a>

   

    <h3>Características</h3>
    <?php
    $sql_caracteristicas = "SELECT * FROM caracteristicas WHERE producto_id='$id'";
    $result_caracteristicas = $connect->query($sql_caracteristicas);
    while ($caracteristica = $result_caracteristicas->fetch_assoc()) {
    ?>
        <input type="hidden" name="caracteristica_id[]" value="<?php echo $caracteristica['id']; ?>" />
        <input type="text" name="caracteristica_titulo[]" value="<?php echo $caracteristica['titulo']; ?>" required />
        <input type="text" name="caracteristica_descripcion[]" value="<?php echo $caracteristica['descripcion']; ?>" required />
    <?php } ?>

    <h3>Especificaciones Técnicas</h3>
    <?php
    $sql_especificaciones = "SELECT * FROM especificaciones_tecnicas WHERE producto_id='$id'";
    $result_especificaciones = $connect->query($sql_especificaciones);
    while ($especificacion = $result_especificaciones->fetch_assoc()) {
    ?>
        <input type="hidden" name="especificacion_id[]" value="<?php echo $especificacion['id']; ?>" />
        <input type="text" name="especificacion_titulo[]" value="<?php echo $especificacion['titulo']; ?>" required />
        <input type="text" name="especificacion_Descripcion[]" value="<?php echo $especificacion['descripcion']; ?>" required />
    <?php } ?>

    <button type="submit">Actualizar</button>
</form>
