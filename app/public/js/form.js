function toggleFields(id) {
    var section = document.getElementById(id);
    section.classList.toggle('hidden');
}

function addField(sectionId, type) {
    var section = document.getElementById(sectionId);
    var div = document.createElement('div');
    div.classList.add('form-group');
    
    if (type === 'caracteristica') {
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