<?php
include "../config/conexion.php";

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
$base_url = "http://localhost/app/app/";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
<body>
    <div class="container">
        <h1>Editar Producto</h1>
        <form method="POST" action="../Model/editarProduct.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required />
            <label>Categoría:</label>
            <input type="text" name="categoria" value="<?php echo $producto['categoria']; ?>" required />
            <label>Sector:</label>
            <input type="text" name="sector" value="<?php echo $producto['sector']; ?>" required />
            <label>Descripción:</label>
            <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>

            <label>Imagen Principal:</label>
            <img src="<?php echo $base_url . 'Control/' . $producto['imagen_principal']; ?>" width="100" alt="Imagen Principal">
            <input type="hidden" name="imagen_principal_actual" value="<?php echo $producto['imagen_principal']; ?>">
            <input type="file" name="imagen_principal" accept="image/*" />

            <label>Ficha Técnica:</label>
            <a href="<?php echo $base_url . 'Control/' . $producto['ficha_tecnica']; ?>" target="_blank">Ver Ficha</a>
            <input type="hidden" name="ficha_tecnica_actual" value="<?php echo $producto['ficha_tecnica']; ?>">
            <input type="file" name="ficha_tecnica" accept=".pdf,.doc,.docx" />

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
    </div>
</body>
</html>