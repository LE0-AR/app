<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Obtener datos del producto
    $sql = "SELECT * FROM productos WHERE id = '$id'";
    $result = $connect->query($sql);
    $producto = $result->fetch_assoc();

    // Obtener características
    $sql_caracteristicas = "SELECT * FROM caracteristicas WHERE producto_id = '$id'";
    $result_caracteristicas = $connect->query($sql_caracteristicas);
    
    // Obtener especificaciones
    $sql_especificaciones = "SELECT * FROM especificaciones_tecnicas WHERE producto_id = '$id'";
    $result_especificaciones = $connect->query($sql_especificaciones);

    // Obtener imágenes secundarias (limitado a 3)
    $sql_imagenes = "SELECT * FROM imagenes_secundarias WHERE producto_id = '$id' LIMIT 3";
    $result_imagenes = $connect->query($sql_imagenes);
}
?>

<div class="containerDetalles">
    <div class="product">
        <div class="thumbnails">
            <!-- Imagen principal -->
            <img src="<?php echo APP_URL; ?>/app/Control/<?php echo $producto['imagen_principal']; ?>" 
                 alt="Imagen Principal" onclick="changeImage(this)">
            
            <!-- Imágenes secundarias -->
            <?php 
            while ($imagen = $result_imagenes->fetch_assoc()) {
                echo '<img src="' . APP_URL . '/app/Control/' . $imagen['imagen_url'] . '" 
                         alt="Imagen secundaria" onclick="changeImage(this)">';
            }
            ?>
        </div>
        <div class="main-image">
            <img id="selectedImage" src="<?php echo APP_URL; ?>/app/Control/<?php echo $producto['imagen_principal']; ?>" 
                 alt="Imagen principal">
        </div>
        <div class="details">
            <h2><?php echo $producto['nombre']; ?></h2>
            <p><?php echo $producto['descripcion']; ?></p>
            <a href="<?php echo APP_URL; ?>/app/Control/<?php echo $producto['ficha_tecnica']; ?>" 
               class="btn" target="_blank">Ver ficha</a>
        </div>
    </div>

    <div class="tables-container">
        <div class="tables-wrapper">
            <?php
            // Verificar si hay características válidas (no N/A)
            $has_valid_caracteristicas = false;
            $caracteristicas_html = '';
            
            while ($caracteristica = $result_caracteristicas->fetch_assoc()) {
                if ($caracteristica['titulo'] != 'N/A' && $caracteristica['descripcion'] != 'N/A') {
                    $has_valid_caracteristicas = true;
                    $caracteristicas_html .= '<tr>
                                                <th>' . $caracteristica['titulo'] . '</th>
                                                <td>' . $caracteristica['descripcion'] . '</td>
                                            </tr>';
                }
            }

            if ($has_valid_caracteristicas) { ?>
                <section class="specifications">
                    <h2 class="tituloEs">CARACTERÍSTICAS</h2>
                    <div class="specs-container">
                        <div class="specs-box">
                            <table>
                                <?php echo $caracteristicas_html; ?>
                            </table>
                        </div>
                    </div>
                </section>
            <?php }

            // Verificar si hay especificaciones válidas (no N/A)
            $has_valid_especificaciones = false;
            $especificaciones_html = '';
            
            while ($especificacion = $result_especificaciones->fetch_assoc()) {
                if ($especificacion['titulo'] != 'N/A' && $especificacion['descripcion'] != 'N/A') {
                    $has_valid_especificaciones = true;
                    $especificaciones_html .= '<tr>
                                                <th>' . $especificacion['titulo'] . '</th>
                                                <td>' . $especificacion['descripcion'] . '</td>
                                            </tr>';
                }
            }

            if ($has_valid_especificaciones) { ?>
                <section class="specifications">
                    <h2 class="tituloEs">ESPECIFICACIONES TÉCNICAS</h2>
                    <div class="specs-container">
                        <div class="specs-box">
                            <table>
                                <?php echo $especificaciones_html; ?>
                            </table>
                        </div>
                    </div>
                </section>
            <?php } ?>
        </div>
    </div>

    <div class="button-container">
        <a href="<?php echo APP_URL; ?>/app/Views/user/ProductUser.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> Regresar
        </a>
    </div>
</div>

<script>
    function changeImage(element) {
        document.getElementById('selectedImage').src = element.src;
        document.querySelectorAll('.thumbnails img').forEach(img => img.classList.remove('active'));
        element.classList.add('active');
    }
</script>