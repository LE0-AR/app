<div class="coneteNew">
    <h2>Registro de Producto</h2>
    <form method="POST" action="<?php echo APP_URL; ?>app/Model/GuardarP.php" enctype="multipart/form-data">
        <!-- Datos generales del producto -->
        <div class="div">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" required />

            <label>Sector:</label>
            <select name="sector" id="sector" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Industrial">Industrial</option>
                <option value="Comercial">Comercial</option>
                <option value="Residencial">Residencial</option>
            </select>
            <span id="error-message" style="color: red; display: none;">Por favor, seleccione un sector válido.</span>

            <script>
                const form = document.querySelector("form");
                const sectorSelect = document.getElementById("sector");
                const errorMessage = document.getElementById("error-message");

                form.addEventListener("submit", function(event) {
                    if (sectorSelect.value === "") {
                        event.preventDefault(); // Evita que el formulario se envíe
                        errorMessage.style.display = "block"; // Muestra el mensaje de error
                    } else {
                        errorMessage.style.display = "none"; // Oculta el mensaje de error si es válido
                    }
                });
            </script>
        </div>


        <label>Categoría:</label>
        <input type="text" name="categoria" required />

        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <!-- Imagen Principal -->
        <label>Imagen Principal:</label>
        <input type="file" name="imagen_principal" accept="image/*" required />

        <!-- Ficha Técnica -->
        <label>Ficha Técnica:</label>
        <input type="file" name="ficha_tecnica" accept=".pdf,.doc,.docx" required />

        <!-- Características -->
        <h3 onclick="toggleFields('caracteristicas')">Características [+]</h3>
        <div id="caracteristicas" class="hidden">
            <button type="button" onclick="addField('caracteristicas', 'caracteristica')">Agregar más</button>
            <ul>
                <li>
                    <div>
                        <input name="caracteristica_titulo[]" placeholder=" " required type="text" />
                        <label class="floating-label">Ingrese el título</label>
                    </div>
                    <div>
                        <input name="caracteristica_descripcion[]" placeholder=" " required type="text" />
                        <label class="floating-label">Ingrese la descripción</label>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Especificaciones Técnicas -->
        <h3 onclick="toggleFields('especificaciones')">Especificaciones Técnicas [+]</h3>
        <div id="especificaciones" class="hidden">
            <button type="button" onclick="addField('especificaciones', 'especificacion')">Agregar más</button>
            <ul>
                <li>
                    <div>
                        <input name="especificacion_titulo[]" placeholder=" " required type="text" />
                        <label class="floating-label">Ingrese la especificación</label>
                    </div>
                    <div>
                        <input name="especificacion_Descripcion[]" placeholder=" " required type="text" />
                        <label class="floating-label">Ingrese el valor</label>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Imágenes secundarias -->
        <label>Imágenes Secundarias:</label>
        <input type="file" name="imagenes_secundarias[]" accept="image/*" multiple />

        <button type="submit">Guardar Producto</button>
    </form>
</div>