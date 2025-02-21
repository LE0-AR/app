<?php
    include "config/conexion.php";

    if ($connect->connect_error) {
        die("Conexión fallida: " . $connect->connect_error);
    }

    $sql = "SELECT productos.*, 
                   caracteristicas.titulo AS caracteristica_titulo, 
                   caracteristicas.descripcion AS caracteristica_descripcion, 
                   especificaciones_tecnicas.especificacion AS especificacion_titulo, 
                   especificaciones_tecnicas.valor AS especificacion_valor, 
                   imagenes_secundarias.imagen_url AS imagen_secundaria
            FROM productos
            LEFT JOIN caracteristicas ON productos.id = caracteristicas.producto_id
            LEFT JOIN especificaciones_tecnicas ON productos.id = especificaciones_tecnicas.producto_id
            LEFT JOIN imagenes_secundarias ON productos.id = imagenes_secundarias.producto_id;";
    
    $result = $connect->query($sql);

    // Definir la URL base para las imágenes
    $base_url = "http://localhost/app/app/";
?>
<div class="container">
    <h1 class="titulo">Lista de Productos</h1>

    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Sector</th>
                <th>Categoría</th>
                <th>Imagen Principal</th>
                <th>Imagen Secundaria</th>
                <th>Descripción</th>
                <th>Ficha Técnica</th>
                <th>Característica</th>
                <th>Especificación</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['sector']; ?></td>
                    <td><?php echo $row['categoria']; ?></td>
                    <td>
                        <?php if (!empty($row['imagen_principal'])) { ?>
                            <img src="<?php echo $base_url . $row['imagen_principal']; ?>" width="80">
                        <?php } else { ?>
                            No imagen
                        <?php } ?>
                    </td>
                    <td>
                        <?php if (!empty($row['imagen_secundaria'])) { ?>
                            <img src="<?php echo $base_url . $row['imagen_secundaria']; ?>" width="80">
                        <?php } else { ?>
                            No imagen secundaria
                        <?php } ?>
                    </td>
                    <td><?php echo $row['descripcion'] ?? "Sin descripción"; ?></td>
                    <td>
                        <?php if (!empty($row['ficha_tecnica'])) { ?>
                            <a href="<?php echo $base_url . $row['ficha_tecnica']; ?>" target="_blank">Ver</a>
                        <?php } else { ?>
                            Sin ficha técnica
                        <?php } ?>
                    </td>
                    <td>
                        <strong><?php echo $row['caracteristica_titulo'] ?? "Sin título"; ?></strong><br>
                        <?php echo $row['caracteristica_descripcion'] ?? "Sin descripción"; ?>
                    </td>
                    <td>
                        <strong><?php echo $row['especificacion_titulo'] ?? "Sin especificación"; ?></strong>: 
                        <?php echo $row['especificacion_valor'] ?? "Sin valor"; ?>
                    </td>
                    <td><button>Eliminar</button> <button>Editar</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
