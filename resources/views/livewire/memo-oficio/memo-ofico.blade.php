<div>
    <x-section-basic>
 <!-- Script de Toastr -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
 <x-floating-search />
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #fff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            th, td {
                border: 1px solid #ccc;
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #007bff;
                color: white;
            }
            input, select, textarea {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                transition: border-color 0.3s;
            }
            input:focus, select:focus, textarea:focus {
                border-color: #007bff;
                outline: none;
            }
            textarea {
            width: 100%;
            min-height: 50px; /* Altura mínima */
            resize: vertical; /* Permitir redimensionar verticalmente */
        }
            .inline-inputs {
                display: flex;
                align-items: center;
            }
            .inline-inputs input {
                width: auto; /* Ajustar el ancho de los inputs */
                margin-right: 5px; /* Espacio entre los inputs */
            }
            button {
                margin-top: 20px;
                padding: 10px 15px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            button:hover {
                background-color: #218838;
            }
            .dynamic-inputs {
                margin-top: 20px;
            }
            /* Ocultar inicialmente la sección de hallazgos */
            #hallazgosSection {
                display: none;
            }
            label {
                font-weight: bold;
                margin-top: 10px;
                display: block;
            }
            input[type="number"],
    input[type="date"],
    input[type="text"],
    textarea {
        border: 2px solid #007bff; /* Color del borde */
        border-radius: 4px; /* Bordes redondeados */
        padding: 5px; /* Espaciado interno */
        transition: border-color 0.3s; /* Transición suave para el color del borde */
        width: 100%; /* Ancho completo */
        box-sizing: border-box; /* Incluir padding y border en el ancho total */
    }
        </style>

        <form id="hallazgosForm" method="POST" action="{{ route('guardar.memo') }}" onsubmit="return validateDates()">
            @csrf
            <input type="hidden" name="anio" value="{{ date('Y') }}"> <!-- Campo oculto para el año -->
            <label for="inputSelect">Selecciona un tipo Memo:</label>
            <select id="inputSelect" name="tipo_hallazgo" onchange="showDynamicInputs()">
                <option value="">Seleccione tipo de Memo</option>
                <option value="ISEG" {{ old('tipo_hallazgo') == 'ISEG' ? 'selected' : '' }}>ISEG</option>
              
            </select>

            <div id="hallazgosSection">
                <label for="num_hallazgos">¿Ingrese el numero de filas que necesite?</label>
     
                <input type="number" id="num_hallazgos" name="num_hallazgos" min="0" value="{{ old('num_hallazgos', 0) }}" oninput="generateInputs()">
                <label>Titulo del Cuadro: <input type="text" name="titulo_cuadro1" required placeholder="Ingrese el tirulo del cuadro "></label>
                <table id="hallazgosTable">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Descripción de hallazgo</th>
                            <th>Unidad Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se generarán las filas dinámicamente -->
                    </tbody>
                </table>

                <div id="dynamicInputs" class="dynamic-inputs"></div>

                <button type="submit" onclick="showSuccessMessage()">Guardar</button>
                <button type="button" onclick="document.getElementById('hallazgosForm').reset(); document.getElementById('hallazgosSection').style.display = 'none';" class="bg-gray-600 text-white rounded-lg px-4 py-2 ml-2">Cerrar</button>
            </div>
        </form>

        <!-- Integrar el componente Livewire para búsqueda -->
        <livewire:search-memo />

        <script>
            const datosGuardados = []; // Array para almacenar los datos guardados
            
            function generateInputs() {
                const numHallazgos = document.getElementById('num_hallazgos').value;
                const tableBody = document.querySelector('#hallazgosTable tbody');
                tableBody.innerHTML = ''; // Limpiar filas existentes
                for (let i = 1; i <= numHallazgos; i++) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${i}</td>
                        <td><textarea name="descripcion[]" required placeholder="Descripción del hallazgo" rows="3"></textarea></td>
                        <td><textarea name="unidad_responsable[]" required placeholder="Unidad Responsable" rows="3"></textarea></td>
                    `;
                    tableBody.appendChild(row);
                }
            }

            function showDynamicInputs() {
                const select = document.getElementById("inputSelect");
                const selectedValue = select.options[select.selectedIndex].value;
                const dynamicInputs = document.getElementById("dynamicInputs");
                const hallazgosSection = document.getElementById("hallazgosSection");

                // Limpiar los inputs dinámicos
                dynamicInputs.innerHTML = "";

                // Mostrar diferentes inputs según la selección
                if (selectedValue === "ISEG") {
                hallazgosSection.style.display = "block"; // Mostrar la sección de hallazgos
                dynamicInputs.innerHTML = `
                  
                <label>UAI/M 
                        <div class="inline-inputs">
                            <input type="text" value="${new Date().getFullYear()}" disabled style="width: auto;" />
                            <input type="hidden" name="anio" value="{{ date('Y') }}" />
                            <span>-</span>
                            <input type="number" name="input_tipo1" min="0" max="999" required maxlength="3" oninput="this.value = this.value.slice(0, 3)" placeholder="Número" />
                        </div>
                    </label>
                    <label>Para: <input type="text" name="par" required placeholder="Ingrese el para"></label>
                    <label>Gerencias Adscritas : <input type="text" name="gerencia" required placeholder="Ingrese la gerencia"></label>
                    <label>Fecha Inicio: <input type="date" name="fecha1" required></label>
                    <label>Fecha Fin: <input type="date" name="fecha2" required></label>
                    <label>Conclusión: <textarea name="conclusion" required placeholder="Ingrese la conclusión aquí"></textarea></label>
                    <label>Recomendaciones: 
    <textarea name="recomendaciones" required placeholder="Ingrese las recomendaciones aquí"></textarea>
</label>
<!-- Nueva sección para Auditoría -->
<div id="auditoriaSection" style="margin-top: 20px;">
    
    <!-- Campo para ingresar el número de filas -->
    <label for="numRows">Ingrese el número de filas:</label>
    <input type="number" id="numRows" min="0" placeholder="Número de filas" oninput="updateTable()">
    <label>Titulo del cuadro: <input type="text" name="titulo_cuadro2" required placeholder="Ingrese el tirulo del cuadro "></label>
    <table id="auditoriaTable">
        <thead>
            <tr>
                <th>N°</th>
                <th>Auditoría/Nº Hallazgo</th>
                <th>Riesgo</th>
                <th>Unidad Responsable</th>
                <th>Transferido a</th>
                <th>Reporte trimestral  / Semestral</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Las filas se generarán aquí -->
        </tbody>
    </table>
</div>

                `;
                } else if (selectedValue === "tipo2") {
                    hallazgosSection.style.display = "block"; // Mostrar la sección de hallazgos
                    dynamicInputs.innerHTML = '<label>Input para Tipo 2: <input type="number" name="input_tipo2" required placeholder="Ingrese un número"></label>';
                } else if (selectedValue === "tipo3") {
                    hallazgosSection.style.display = "block"; // Mostrar la sección de hallazgos
                    dynamicInputs.innerHTML = '<label>Input para Tipo 3: <textarea name="input_tipo3" required placeholder="Ingrese detalles aquí"></textarea></label>';
                } else {
                    hallazgosSection.style.display = "none"; // Ocultar la sección de hallazgos si no se selecciona nada
                }
            }

            function updateTable() {
    const numRows = document.getElementById('numRows').value;
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = ''; // Limpiar filas existentes

    for (let i = 0; i < numRows; i++) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="number" name="numero[]" value="${i + 1}" readonly style="width: 50px; text-align: center; border: none; outline: none;"></td>
            <td><textarea name="auditoria[]" required placeholder="Auditoría/Nº Hallazgo" rows="2" style="resize: vertical;"></textarea></td>
            <td><textarea name="riesgo[]" required placeholder="Riesgo" rows="2" style="resize: vertical;"></textarea></td>
            <td><textarea name="unidad_responsable_auditoria[]" required placeholder="Unidad Responsable" rows="2" style="resize: vertical;"></textarea></td>
            <td><textarea name="transferido_a[]" required placeholder="Transferido a" rows="2" style="resize: vertical;"></textarea></td>
           
        <td>
    <input type="text" name="fechas_reporte[]" required placeholder="Transferido a o Fecha" style="width: 100%;" onblur="validateDateOrText(this)">
</td>
        `;
        tableBody.appendChild(row);
    }
}
function validateDateOrText(input) {
    const value = input.value;
    const datePattern = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/; // Formato de fecha DD/MM/YYYY
    const letterPattern = /^[a-zA-Z\s]*$/; // Permitir solo letras y espacios

    if (value.match(datePattern)) {
        const parts = value.split('/');
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10);
        const year = parseInt(parts[2], 10);
        
        // Verificar si la fecha es válida
        const date = new Date(year, month - 1, day);
        if (date.getFullYear() !== year || date.getMonth() + 1 !== month || date.getDate() !== day) {
            alert('Por favor, ingrese una fecha válida.');
            input.value = ''; // Limpiar el campo si no es una fecha válida
        }
    } else if (value.match(letterPattern)) {
        // Permitir letras y no hacer nada
        return; // Salir de la función si es solo texto
    } else {
        // Aquí puedes agregar más validaciones para el texto si es necesario
        if (value.trim() === '') {
            alert('Por favor, ingrese un texto válido.');
            input.value = ''; // Limpiar el campo si está vacío
        } else {
            alert('Por favor, ingrese una fecha en el formato DD/MM/YYYY o texto válido.');
            input.value = ''; // Limpiar el campo si no es una fecha válida
        }
    }
}
            function validateDates() {
                const fecha1 = document.querySelector('input[name="fecha1"]')?.value;
                const fecha2 = document.querySelector('input[name="fecha2"]')?.value;

                // Verificar que ambas fechas existan
                if (fecha1 && fecha2) {
                    const date1 = new Date(fecha1);
                    const date2 = new Date(fecha2);

                    // Verificar que la fecha 1 no sea mayor que la fecha 2
                    if (date1 > date2) {
                        alert("La Fecha 1 no puede ser mayor que la Fecha 2.");
                        return false; // Evitar el envío del formulario
                    }
                }

                return true; // Permitir el envío del formulario
            }

            // Función para manejar el envío del formulario
            document.getElementById('hallazgosForm').addEventListener('submit', function(event) {
                // Validar fechas antes de enviar
                if (!validateDates()) {
                    event.preventDefault(); // Solo prevenir el envío si la validación falla
                    return;
                }
            });

            // Función para mostrar los datos en la tabla
            function mostrarDatos() {
                const tableBody = document.querySelector('#dataTable tbody');
                tableBody.innerHTML = ''; // Limpiar la tabla

                datosGuardados.forEach(dato => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${dato.id}</td>
                        <td>${dato.descripcion}</td>
                                                <td>${dato.unidad}</td>
                        <td>${dato.fecha}</td>
                    `;
                    tableBody.appendChild(row);
                });
            }
            
            function showSuccessMessage() {
                toastr.success('Se ha guardado con éxito', 'Éxito', {
                    positionClass: 'toast-bottom-right',
                    timeOut: 5000,
                });
            }
        </script>

    </x-section-basic>
</div>