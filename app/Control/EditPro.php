<?php

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

    <div class="container">
        <h2>Editar Producto</h2>
        <form method="POST" action="../../Model/user/EditUSer.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="sector">Sectores</label>
                    <select class="form-control" name="sector" id="sector" required>
                        <option value="" disabled>Seleccione un sector</option>
                        <option value="Telcos" <?php echo ($producto['sector'] == 'Telcos') ? 'selected' : ''; ?>>Telecomunicaciones e IT</option>
                        <option value="Electricidad" <?php echo ($producto['sector'] == 'Electricidad') ? 'selected' : ''; ?>>Planta externa y electricidad</option>
                        <option value="ExhibicionAl" <?php echo ($producto['sector'] == 'ExhibicionAl') ? 'selected' : ''; ?>>Exhibición y almacenaje</option>
                        <option value="MobiliarioU" <?php echo ($producto['sector'] == 'MobiliarioU') ? 'selected' : ''; ?>>Mobiliario Urbano</option>
                        <option value="Torres" <?php echo ($producto['sector'] == 'Torres') ? 'selected' : ''; ?>>Torres</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="categoria">Categoría:</label>
                    <input type="text" class="form-control" name="categoria" value="<?php echo $producto['categoria']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="2" required><?php echo $producto['descripcion']; ?></textarea>
                </div>
                <div class="form-group col-md-3">
                    <label for="imagen_principal">Imagen Principal:</label>
                    <img src="<?php echo $base_url . 'Control/' . $producto['imagen_principal']; ?>" width="100" alt="Imagen Principal">
                    <input type="hidden" name="imagen_principal_actual" value="<?php echo $producto['imagen_principal']; ?>">
                    <input type="file" class="form-control-file" name="imagen_principal" accept="image/*">
                </div>
                <div class="form-group col-md-3">
                    <label for="ficha_tecnica">Ficha Técnica:</label>
                    <a href="<?php echo $base_url . 'Control/' . $producto['ficha_tecnica']; ?>" target="_blank">Ver Ficha</a>
                    <input type="hidden" name="ficha_tecnica_actual" value="<?php echo $producto['ficha_tecnica']; ?>">
                    <input type="file" class="form-control-file" name="ficha_tecnica" accept=".pdf,.doc,.docx">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="imagenes_secundarias">Imágenes Secundarias:</label>
                    <div>
                        <?php
                        $sql_imagenes = "SELECT * FROM imagenes_secundarias WHERE producto_id='$id'";
                        $result_imagenes = $connect->query($sql_imagenes);
                        while ($imagen = $result_imagenes->fetch_assoc()) {
                            echo '<img src="' . $base_url . 'Control/' . $imagen['imagen_url'] . '" width="100" alt="Imagen Secundaria">';
                        }
                        ?>
                    </div>
                    <input type="file" class="form-control-file" name="imagenes_secundarias[]" accept="image/*" multiple>
                </div>
            </div>
            <br>
            <strong>
                <p>Si no cuenta con características o especificaciones técnicas, agregar "N/A".</p>
            </strong>
            <h2>Características</h2>
            <button type="button" class="btn btn-outline-success" onclick="agregarCaracteristica()">Añadir Característica</button>
            <button type="button" class="btn btn-outline-danger" onclick="eliminarCaracteristica()">Eliminar Característica</button>
            <div id="caracteristicas">
                <?php
                $sql_caracteristicas = "SELECT * FROM caracteristicas WHERE producto_id='$id'";
                $result_caracteristicas = $connect->query($sql_caracteristicas);
                while ($caracteristica = $result_caracteristicas->fetch_assoc()) {
                ?>
                    <div class="form-row">
                        <input type="hidden" name="caracteristica_id[]" value="<?php echo $caracteristica['id']; ?>">
                        <div class="form-group col-md-6">
                            <label for="caracteristica_titulo">Título:</label>
                            <input type="text" class="form-control" name="caracteristica_titulo[]" value="<?php echo $caracteristica['titulo']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="caracteristica_descripcion">Descripción:</label>
                            <input type="text" class="form-control" name="caracteristica_descripcion[]" value="<?php echo $caracteristica['descripcion']; ?>" required>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <hr>
            <h2>Especificaciones técnicas</h2>
            <button type="button" class="btn btn-outline-success" onclick="agregarEspecificacion()">Añadir Especificación</button>
            <button type="button" class="btn btn-outline-danger" onclick="eliminarEspecificacion()">Eliminar Especificación</button>
            <div id="especificaciones">
                <?php
                $sql_especificaciones = "SELECT * FROM especificaciones_tecnicas WHERE producto_id='$id'";
                $result_especificaciones = $connect->query($sql_especificaciones);
                while ($especificacion = $result_especificaciones->fetch_assoc()) {
                ?>
                    <div class="form-row">
                        <input type="hidden" name="especificacion_id[]" value="<?php echo $especificacion['id']; ?>">
                        <div class="form-group col-md-6">
                            <label for="especificacion_titulo">Título:</label>
                            <input type="text" class="form-control" name="especificacion_titulo[]" value="<?php echo $especificacion['titulo']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="especificacion_descripcion">Descripción:</label>
                            <input type="text" class="form-control" name="especificacion_descripcion[]" value="<?php echo $especificacion['descripcion']; ?>" required>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <br><br>
            <button type="submit" class="btn btn-outline-primary">Actualizar Producto</button>
        </form>
    </div>
    <script>
        function agregarCaracteristica() {
            const caracteristicasDiv = document.getElementById('caracteristicas');
            const nuevaCaracteristica = document.createElement('div');
            nuevaCaracteristica.classList.add('form-row');
            nuevaCaracteristica.innerHTML = `
                <div class="form-group col-md-6">
                    <label for="caracteristica_titulo">Título:</label>
                    <input type="text" class="form-control" name="caracteristica_titulo[]" placeholder="Ingrese el título" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="caracteristica_descripcion">Descripción:</label>
                    <input type="text" class="form-control" name="caracteristica_descripcion[]" placeholder="Ingrese la descripción" required>
                </div>
            `;
            caracteristicasDiv.appendChild(nuevaCaracteristica);
        }

        function eliminarCaracteristica() {
            const caracteristicasDiv = document.getElementById('caracteristicas');
            if (caracteristicasDiv.children.length > 1) {
                caracteristicasDiv.removeChild(caracteristicasDiv.lastChild);
            }
        }

        function agregarEspecificacion() {
            const especificacionesDiv = document.getElementById('especificaciones');
            const nuevaEspecificacion = document.createElement('div');
            nuevaEspecificacion.classList.add('form-row');
            nuevaEspecificacion.innerHTML = `
                <div class="form-group col-md-6">
                    <label for="especificacion_titulo">Título:</label>
                    <input type="text" class="form-control" name="especificacion_titulo[]" placeholder="Ingrese el título" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="especificacion_descripcion">Descripción:</label>
                    <input type="text" class="form-control" name="especificacion_descripcion[]" placeholder="Ingrese la descripción" required>
                </div>
            `;
            especificacionesDiv.appendChild(nuevaEspecificacion);
        }

        function eliminarEspecificacion() {
            const especificacionesDiv = document.getElementById('especificaciones');
            if (especificacionesDiv.children.length > 1) {
                especificacionesDiv.removeChild(especificacionesDiv.lastChild);
            }
        }
    </script>
