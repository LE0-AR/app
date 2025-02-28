function toggleFields(id) {
    var section = document.getElementById(id);
    section.classList.toggle('hidden');
}

function addField(sectionId, type) {
    var section = document.getElementById(sectionId);
    var div = document.createElement('div');
    div.classList.add('form-group');
    
    if (type === 'caracteristica') { function agregarCaracteristica() {
        const caracteristicasDiv = document.getElementById('caracteristicas');
        const nuevaCaracteristica = document.createElement('div');
        nuevaCaracteristica.classList.add('form-row');
        nuevaCaracteristica.innerHTML = `
          <div class="form-group col-md-6">
            <label for="caracteristicaTitulo">Título:</label>
            <input type="text" class="form-control" name="caracteristica_titulo[]" placeholder="Ingrese el título" required>
          </div>
          <div class="form-group col-md-6">
            <label for="caracteristicaDescripcion">Descripción:</label>
            <input type="text" class="form-control" name="caracteristica_descripcion[]" placeholder="Ingrese la descripción" required>
          </div>
        `;
        caracteristicasDiv.appendChild(nuevaCaracteristica);
      }
    //Funccion para eliminar los 
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
            <label for="especificacionTitulo">Título:</label>
            <input type="text" class="form-control" name="especificacion_titulo[]" placeholder="Ingrese el título" required>
          </div>
          <div class="form-group col-md-6">
            <label for="especificacionDescripcion">Descripción:</label>
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
        div.innerHTML = `
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
        `;
    } else if (type === 'especificacion') {
        div.innerHTML = `
            <li>
                <div>
                    <input name="especificacion_titulo[]" placeholder=" " required type="text" />
                    <label class="floating-label">Ingrese la especificación</label>
                </div>
                <div>
                    <input name="especificacion_valor[]" placeholder=" " required type="text" />
                    <label class="floating-label">Ingrese el valor</label>
                </div>
            </li>
        `;
    }

    section.appendChild(div);
}