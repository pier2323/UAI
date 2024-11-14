<!DOCTYPE html>
<html lang="es">
<head>
    @php
    // Formatear las fechas en el formato dd-mm-yyyy
$fechaInicio = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->subscription));
$fechaFin = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->delivery_uai)); // Cambia esto si quieres usar una fecha fija
@endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        .container {
            background-color: #e8f5e9; /* Color pastel */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .calendar-container {
            display: none; /* Ocultar inicialmente */
            opacity: 0; /* Opacidad inicial */
            transition: opacity 0.5s ease; /* Transición de opacidad */
        }
        .calendar-container.show {
            display: flex; /* Mostrar como flex */
            opacity: 1; /* Opacidad final */
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            width: 100%;
            padding: 10px;
        }
        .day {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
        }
        .weekend { background-color: #ffcccb; }
        .holiday { background-color: #ffeeba; }
        .working-day { background-color: #c3e6cb; }
        .selected-day { background-color: #007bff; color: white; }
        .result-day { background-color: #ff9800; color: white; } /* Resaltar el día del resultado */
        .month-year {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            grid-column: span 7;
        }
        .day-header {
            font-weight: bold;
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .navigation {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .nav-button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 5px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 12px; /* Tamaño más pequeño */
            width: 30px; /* Ancho más pequeño */
            margin: 5px;
        }
        .legend {
            margin-top: 10px;
            font-size: 14px;
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 10px;
            background-color: #f8f9fa;
            color: #333;
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Calendario Interactivo</h1>
        <label for="startDate">Fecha de Inicio:</label>
        <input type="date" id="startDate" required>
        
        <button onclick="showSelectedDate()">Mostrar Fecha</button>
        <button onclick="resetCalendar()">Reiniciar</button>

        <div class="result" id="result"></div>
        
        <div class="calendar-container" id="calendarContainer">
            <div class="navigation" id="navigation" style="display: none;">
                <button class="nav-button" onclick="changeMonth(-1)">◀</button>
                <div id="calendarDisplay"></div>
                <button class="nav-button" onclick="changeMonth(1)">▶</button>
            </div>
        </div>

        <div class="legend" id="legend" style="display: none;"></div>
    </div>
   
    <script>
        const holidays = [
              // Días festivos de 2024
            new Date('2024-01-01'), // Año Nuevo
            new Date('2024-02-12'), // Carnaval
            new Date('2024-02-13'), // Carnaval
            new Date('2024-03-28'), // jueves santo
            new Date('2024-03-29'), // viernes Santo
            new Date('2024-04-19'), // Declaracion Indevendencia
            new Date('2024-05-01'), // Día del Trabajador
            new Date('2024-06-24'), // Día de la Batalla de Carabobo
            new Date('2024-07-05'), // Día de la Independencia
            new Date('2024-07-24'), // Natalicio de Simón Bolivar
            new Date('2024-07-28'), // telecominicador
            new Date('2024-12-24'), // Navidad
            new Date('2024-12-25'), // Navidad
            new Date('2024-12-31'), //Fin de Año
             // Días festivos de 2025
            new Date('2025-01-01'), // Año Nuevo
            new Date('2025-03-3'), //  Lunes Carnaval
            new Date('2025-03-4'), // Martes Carnaval
            new Date('2025-04-17'), // jueves santo
            new Date('2025-04-18'), // viernes Santo
            new Date('2025-04-19'), // Declaracion Indevendencia
            new Date('2025-05-01'), // Día del Trabajador
            new Date('2025-06-24'), // Día de la Batalla de Carabobo
            new Date('2025-07-05'), // Día de la Independencia
            new Date('2025-07-24'), // Natalicio de Simón Bolivar
            new Date('2025-07-28'), // telecominicador
            new Date('2025-12-24'), // Navidad
            new Date('2025-12-25'), // Navidad
            new Date('2025-12-31'), //Fin de Año

        ];
        

        let selectedDate;
        const monthNames = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];

        function showSelectedDate() {
            const startDateInput = document.getElementById('startDate').value;
            if (!startDateInput) {
                alert("Por favor, selecciona una fecha de inicio.");
                return;
            }

            // Crear la fecha seleccionada
            selectedDate = new Date(startDateInput + 'T00:00:00');

            document.getElementById('result').innerText = `Mes Seleccionado: ${monthNames[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`;

            // Calcular la fecha de resultado después de sumar 120 días hábiles
            const resultDate = addBusinessDays(selectedDate, 120);
            highlightResultDay(resultDate);

            // Calcular días hábiles transcurridos desde el día siguiente a la fecha de inicio hasta hoy
            const today = new Date();
            const daysSinceStart = countBusinessDays(new Date(selectedDate.getTime() + 24 * 60 * 60 * 1000), today);
            const daysToResult = 120; // Días hábiles a sumar

            // Formato de la leyenda
            document.getElementById('legend').innerHTML = `
                <strong>Leyenda:</strong><br>
                Desde el ${selectedDate.getDate()} de ${monthNames[selectedDate.getMonth()]} de ${selectedDate.getFullYear()} hasta hoy: <strong>${daysSinceStart} días hábiles</strong><br>
                Desde el ${selectedDate.getDate()} de ${monthNames[selectedDate.getMonth()]} de ${selectedDate.getFullYear()} hasta el ${resultDate.getDate()} de ${monthNames[resultDate.getMonth()]} de ${resultDate.getFullYear()}: <strong>${daysToResult} días hábiles</strong>
               
            `;

            
            document.getElementById('legend').style.display = 'block'; // Mostrar la leyenda

            updateCalendar();

            // Mostrar el calendario con transición
            const calendarContainer = document.getElementById('calendarContainer');
            calendarContainer.classList.add('show'); // Añadir clase para mostrar
            document.getElementById('navigation').style.display = 'flex';
        }

        function countBusinessDays(startDate, endDate) {
            let currentDate = new Date(startDate);
            let businessDays = 0;

            while (currentDate <= endDate) {
                // Verificar si es un día hábil (no sábado, domingo ni festivo)
                if (currentDate.getDay() !== 0 && currentDate.getDay() !== 6 && !holidays.some(holiday => holiday.toDateString() === currentDate.toDateString())) {
                    businessDays++;
                }
                currentDate.setDate(currentDate.getDate() + 1);
            }
            return businessDays;
        }

        function addBusinessDays(startDate, days) {
            let currentDate = new Date(startDate);
            let addedDays = 0;

            while (addedDays < days) {
                currentDate.setDate(currentDate.getDate() + 1);

// Verificar si es un día hábil (no sábado, domingo ni festivo)
if (currentDate.getDay() !== 0 && currentDate.getDay() !== 6 && !holidays.some(holiday => holiday.toDateString() === currentDate.toDateString())) {
    addedDays++;
}
}
return currentDate;
}

function highlightResultDay(resultDate) {
// Resaltar el día de resultado en el calendario
const calendarDisplay = document.getElementById('calendarDisplay');
const days = calendarDisplay.getElementsByClassName('day');

for (let dayElement of days) {
const dayNumber = parseInt(dayElement.innerText);
const dayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), dayNumber);

// Comparar si el día en el calendario es igual a la fecha de resultado
if (dayDate.toDateString() === resultDate.toDateString()) {
    dayElement.classList.add('result-day');
}
}
}

function updateCalendar() {
const year = selectedDate.getFullYear();
const month = selectedDate.getMonth();
const firstDay = new Date(year, month, 1);
const lastDay = new Date(year, month + 1, 0); // Último día del mes

const calendarDisplay = document.getElementById('calendarDisplay');
calendarDisplay.innerHTML = ''; // Limpiar el calendario existente

// Mostrar el mes y el año
const monthYearDisplay = document.createElement('div');
monthYearDisplay.className = 'month-year';
monthYearDisplay.innerText = `${monthNames[month]} ${year}`;
calendarDisplay.appendChild(monthYearDisplay);

// Crear encabezados de días
const dayHeaders = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
const headerContainer = document.createElement('div');
headerContainer.className = 'calendar';
dayHeaders.forEach(header => {
const headerElement = document.createElement('div');
headerElement.className = 'day-header';
headerElement.innerText = header;
headerContainer.appendChild(headerElement);
});
calendarDisplay.appendChild(headerContainer);

// Crear el calendario
const calendar = document.createElement('div');
calendar.className = 'calendar';

// Agregar días en blanco para la primera semana
const startDayIndex = (firstDay.getDay() + 6) % 7; // Ajustar para que Lun sea 0
for (let i = 0; i < startDayIndex; i++) {
const emptyDay = document.createElement('div');
emptyDay.className = 'day';
calendar.appendChild(emptyDay);
}

// Agregar días del mes
for (let day = 1; day <= lastDay.getDate(); day++) {
const dayElement = document.createElement('div');
const currentDay = new Date(year, month, day);
dayElement.className = 'day';

// Verificar si es fin de semana o festivo
if (currentDay.getDay() === 0 || currentDay.getDay() === 6) {
    dayElement.classList.add('weekend');
} else if (holidays.some(holiday => holiday.toDateString() === currentDay.toDateString())) {
    dayElement.classList.add('holiday');
} else {
    dayElement.classList.add('working-day');
}

// Resaltar el día seleccionado
if (currentDay.toDateString() === selectedDate.toDateString()) {
    dayElement.classList.add('selected-day');
}

// Resaltar el día de resultado
if (currentDay.toDateString() === addBusinessDays(selectedDate, 120).toDateString()) {
    dayElement.classList.add('result-day');
}

dayElement.innerText = day;
dayElement.onclick = () => selectDay(currentDay);
calendar.appendChild(dayElement);
}

calendarDisplay.appendChild(calendar);
}

function selectDay(date) {
alert(`Has seleccionado el día: ${date.getDate()} de ${monthNames[date.getMonth()]} de ${date.getFullYear()}`);
}

function changeMonth(direction) {
const currentMonth = selectedDate.getMonth();
const currentYear = selectedDate.getFullYear();
selectedDate.setMonth(currentMonth + direction);

// Si el mes se vuelve negativo o mayor a 11, ajustar el año
if (selectedDate.getMonth() < 0) {
    selectedDate.setFullYear(currentYear - 1);
                selectedDate.setMonth(11);
            } else if (selectedDate.getMonth() > 11) {
                selectedDate.setFullYear(currentYear + 1);
                selectedDate.setMonth(0);
            }

            updateCalendar();
        }

        function resetCalendar() {
            document.getElementById('startDate').value = '';
            document.getElementById('result').innerText = '';
            document.getElementById('legend').innerText = '';
            document.getElementById('legend').style.display = 'none';
            document.getElementById('calendarContainer').classList.remove('show');
            document.getElementById('navigation').style.display = 'none';
        }
        
function openSecondModal() {
    const checkboxes = document.querySelectorAll('#checkboxForm input[type="checkbox"]');
    const uncheckedContainer = document.getElementById('uncheckedCheckboxesContainer');
    uncheckedContainer.innerHTML = '';

    checkboxes.forEach((checkbox, index) => {
        if (checkbox.id !== 'checkbox25') { // Excluir el checkbox de "Sin Hallazgo"
        const inputHidden = document.createElement('input');
            inputHidden.type = 'hidden';
            inputHidden.name = `checkboxes[${index}]`;
            inputHidden.value = checkbox.checked ? '0' : '1'; // Marcados son 0 y no marcados son 1
            uncheckedContainer.appendChild(inputHidden);

            if (!checkbox.checked) {
                const div = document.createElement('div');
                div.textContent = checkbox.value;
                uncheckedContainer.appendChild(div);

                const textarea = document.createElement('textarea');
                textarea.name = `uncheckedCheckboxes[${index}]`;
                textarea.placeholder = `Input for ${checkbox.value}`;
                textarea.value = textosPorDefecto[checkbox.id] || ''; // Mensaje por defecto individual
                uncheckedContainer.appendChild(textarea);
            }
        }
    });

    // Verificar si el checkbox "Sin Hallazgo" está marcado
    const sinHallazgoCheckbox = document.getElementById('checkbox25');
    if (sinHallazgoCheckbox.checked) {
        const sinHallazgoLabel = document.createElement('label');
        sinHallazgoLabel.textContent = 'Sin Hallazgo:';
        uncheckedContainer.appendChild(sinHallazgoLabel); // Agregar el nombre del checkbox

        const sinHallazgoInput = document.createElement('textarea'); // Cambiar a textarea para mayor tamaño
        sinHallazgoInput.name = 'sinHallazgo';
        sinHallazgoInput.placeholder = 'Ingrese detalles sobre el hallazgo...';
        sinHallazgoInput.value = 'Sin Hallazgo'; // Valor por defecto
        sinHallazgoInput.style.width = '100%'; // Ajustar el ancho
        sinHallazgoInput.style.height = '100px'; // Ajustar la altura
        sinHallazgoInput.style.overflowY = 'scroll'; // Agregar scroll vertical
        uncheckedContainer.appendChild(sinHallazgoInput);
    }
    
    closeModal('firstModal');
    setTimeout(() => { openModal('secondModal'); }, 500); // Esperar la transición antes de abrir el segundo modal
}            const diasFeriados = [
        new Date('2024-01-01'), // Año Nuevo
            new Date('2024-02-12'), // Carnaval
            new Date('2024-02-13'), // Carnaval
            new Date('2024-03-28'), // jueves santo
            new Date('2024-03-29'), // viernes Santo
            new Date('2024-04-19'), // Declaracion Indevendencia
            new Date('2024-05-01'), // Día del Trabajador
            new Date('2024-06-24'), // Día de la Batalla de Carabobo
            new Date('2024-07-05'), // Día de la Independencia
            new Date('2024-07-24'), // Natalicio de Simón Bolivar
            new Date('2024-07-28'), // telecominicador
            new Date('2024-12-24'), // Navidad
            new Date('2024-12-25'), // Navidad
            new Date('2024-12-31'), //Fin de Año
             // Días festivos de 2025
            new Date('2025-01-01'), // Año Nuevo
            new Date('2025-03-3'), //  Lunes Carnaval
            new Date('2025-03-4'), // Martes Carnaval
            new Date('2025-04-17'), // jueves santo
            new Date('2025-04-18'), // viernes Santo
            new Date('2025-04-19'), // Declaracion Indevendencia
            new Date('2025-05-01'), // Día del Trabajador
            new Date('2025-06-24'), // Día de la Batalla de Carabobo
            new Date('2025-07-05'), // Día de la Independencia
            new Date('2025-07-24'), // Natalicio de Simón Bolivar
            new Date('2025-07-28'), // telecominicador
            new Date('2025-12-24'), // Navidad
            new Date('2025-12-25'), // Navidad
            new Date('2025-12-31'), //Fin de Año
];
function calcularDiasHabiles(fechaInicio, fechaFin) {
    let contador = 0;
    const [diaInicio, mesInicio, anioInicio] = fechaInicio.split('-').map(Number);
    const [diaFin, mesFin, anioFin] = fechaFin.split('-').map(Number);
    const fecha1 = new Date(anioInicio, mesInicio - 1, diaInicio + 1); // Sumar un día a la fecha de inicio
    const fecha2 = new Date(anioFin, mesFin - 1, diaFin);
function esDiaHabil(fecha) {
    const dia = fecha.getDay(); // 0 = Domingo, 6 = Sábado
    const fechaFormateada = fecha.toLocaleDateString('es-ES'); // Formato dd-mm-yyyy
    return dia !== 0 && dia !== 6 && !diasFeriados.includes(fechaFormateada);
}


    // Asegurarse de que fecha1 sea la más antigua
    if (fecha1 > fecha2) {
        [fecha1, fecha2] = [fecha2, fecha1];
    }

    // Iterar a través de cada día entre las dos fechas
    for (let dia = fecha1; dia <= fecha2; dia.setDate(dia.getDate() + 1)) {
        if (esDiaHabil(dia)) {
            contador++;
        }
    }
    return contador;
}

function calcularDiferenciaDias(fechaInicio, fechaFin) {
    const fecha1 = new Date(fechaInicio);
    const fecha2 = new Date(fechaFin);
    const diferenciaTiempo = fecha2 - fecha1; // Diferencia en milisegundos
    const diferenciaDias = diferenciaTiempo / (1000 * 3600 * 24); // Convertir a días
    return diferenciaDias;
}
document.addEventListener('DOMContentLoaded', function() {
const checkbox = document.getElementById('checkbox21'); // Checkbox a desmarcar
const mensajeDiv = document.getElementById('mensaje'); // Div para mostrar el mensaje de sobrepaso
const mensajeDentroDiv = document.getElementById('mensajeDentro'); // Div para el mensaje dentro de los 5 días
const fechaInicio = '<?php echo $fechaInicio; ?>'; // Fecha de inicio en formato dd-mm-yyyy
const fechaFin = '22-11-2024'; // Fecha de fin fija para pruebas
const sinHallazgoCheckbox = document.getElementById('checkbox25'); // Checkbox "Sin Hallazgo"
const nuevaFecha = '22-11-2024'; // Nueva fecha para comparar (puedes cambiarla según sea necesario)
const checkbox1 = document.getElementById('checkbox1'); // Checkbox que se debe desmarcar y bloquear

// Calcular la cantidad de días hábiles
const diasHabiles = calcularDiasHabiles(fechaInicio, fechaFin);

// Comprobar la cantidad de días hábiles
if (diasHabiles > 5) {
    checkbox.checked = false; // Desmarcar el checkbox
    checkbox.disabled = true; // Opcional: deshabilitar el checkbox
    checkbox.parentNode.style.color = 'gray'; // Cambiar el color del texto

// Mostrar mensaje en el div
mensajeDiv.style.display = 'block'; // Hacer visible el mensaje
mensajeDiv.innerHTML = `La acta sobrepasa los 5 días por <strong>${diasHabiles - 5}</strong> días.`;
mensajeDentroDiv.style.display = 'none'; // Ocultar mensaje dentro de los 5 días

// Desmarcar y deshabilitar "Sin Hallazgo" si hay checkboxes marcados
const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#checkbox25)');
const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
if (anyChecked) {
    sinHallazgoCheckbox.checked = false;
    sinHallazgoCheckbox.disabled = true;
    sinHallazgoCheckbox.parentNode.style.color = 'gray';
}
} else {
    checkbox.checked = true; // Marcar el checkbox si es menor o igual a 5
    checkbox.disabled = false; // Asegurarse de que esté habilitado
    checkbox.parentNode.style.color = 'black'; // Cambiar el color del texto
    
    // Ocultar el mensaje de sobrepaso
    mensajeDiv.style.display = 'none';

    // Mostrar mensaje dentro de los 5 días
    mensajeDentroDiv.style.display = 'block'; // Hacer visible el mensaje dentro de los 5 días
    mensajeDentroDiv.innerHTML = `La acta está dentro de los 5 días hábiles.`;
    mensajeDentroDiv.style.color = 'green'; // Cambiar el color del texto a verde
    mensajeDentroDiv.style.fontWeight = 'bold'; // Hacer el texto en negrita
}

// Cálculo de días hábiles entre fechaInicio y nuevaFecha
const diasHabilesComparacion = calcularDiasHabiles(fechaInicio, nuevaFecha);
const mensajeComparacionDiv = document.getElementById('mensajeComparacion'); // Div para mostrar el mensaje de comparación

// Comprobar la cantidad de días hábiles en la comparación
if (diasHabilesComparacion > 3) {
    checkbox.checked = false; // Desmarcar el checkbox si supera 3 días hábiles
    checkbox.disabled = true; // Deshabilitar el checkbox
checkbox.parentNode.style.color = 'gray'; // Cambiar el color del texto

// Bloquear y desmarcar el checkbox1
checkbox1.checked = false; // Desmarcar checkbox1
checkbox1.disabled = true; // Deshabilitar checkbox1
checkbox1.parentNode.style.color = 'gray'; // Cambiar el color del texto de checkbox1

mensajeComparacionDiv.style.display = 'block'; // Hacer visible el mensaje
mensajeComparacionDiv.innerHTML = `La diferencia supera los 3 días hábiles por <strong>${diasHabilesComparacion - 3}</strong> días.`;
} else if (diasHabilesComparacion < 3) {
    mensajeComparacionDiv.style.display = 'block'; // Hacer visible el mensaje
    mensajeComparacionDiv.innerHTML = `La diferencia es menor a 3 días hábiles por <strong>${3 - diasHabilesComparacion}</strong> días.`;
    mensajeComparacionDiv.style.color = 'green'; // Cambiar el color del texto a verde
    mensajeComparacionDiv.style.fontWeight = 'bold'; // Hacer el texto en negrita
} else {
    mensajeComparacionDiv.style.display = 'block'; // Hacer visible el mensaje
mensajeComparacionDiv.innerHTML = `La diferencia es exactamente de <strong>3 días hábiles</strong>.`;
}
});
    const auditCode = "{{ $this->auditActivity->code }}"; // Asignar el código de auditoría a una variable de JavaScript
    document.addEventListener('DOMContentLoaded', function() {
    const requerimientoButton = document.getElementById('requerimiento');
    const emailForm = document.getElementById('emailForm');
    const sendEmailButton = document.getElementById('sendEmailButton');
    const uniqueId = `requerimientoButtonState_${auditCode}`; // ID único para almacenar el estado basado en el código de auditoría

    // Ocultar el formulario por defecto
    emailForm.style.display = 'none';
    
    // Verificar el estado del botón "Requerimiento" en localStorage
    const isRequerimientoDisabled = localStorage.getItem(uniqueId);
    
    // Si el botón está deshabilitado, cambiar su estado
    if (isRequerimientoDisabled === 'true') {
        requerimientoButton.disabled = true;
        requerimientoButton.innerText = 'Requerimiento Enviado'; // Cambiar el texto del botón
        emailForm.style.display = 'block'; // Mostrar el formulario "Enviar Correo"
    }

    requerimientoButton.addEventListener('click', function() {
        // Aquí puedes agregar la lógica para descargar el documento
        descargarDocumento().then(() => {
            // Desactivar el botón "Requerimiento"
            requerimientoButton.disabled = true;
            requerimientoButton.innerText = 'Requerimiento Enviado'; // Cambiar el texto del botón
            localStorage.setItem(uniqueId, 'true'); // Guardar estado en localStorage
            emailForm.style.display = 'block'; // Mostrar el formulario "Enviar Correo"
            location.reload(); // Recargar la página después de la descarga
        });
    });

    // Evento para enviar el formulario
    sendEmailButton.addEventListener('click', function() {
        // Cambiar el texto del botón a "Enviando Requerimiento"
        sendEmailButton.innerText = 'Enviando Requerimiento'; // Cambiar el texto del botón
        // Aquí puedes agregar la lógica para enviar el correo
    });
    
    // Doble clic para ocultar el botón "Enviar Correo"
    sendEmailButton.addEventListener('dblclick', function() {
        emailForm.style.display = 'none'; // Ocultar el formulario "Enviar Correo"
    });
    
    // Agregar eventos para otros botones
    document.querySelectorAll('x-button').forEach(button => {
        button.addEventListener('click', function() {
            // Aquí puedes agregar la lógica para cada uno de los otros botones
            location.reload(); // Recargar la página después de la descarga
        });
    });
});

// Función simulada para descargar el documento
function descargarDocumento() {
    return new Promise((resolve) => {
        // Simulación de un retraso de descarga de 2 segundos
        setTimeout(() => {
            console.log("Documento de requerimiento descargado"); // Aquí puedes manejar la lógica real de descarga
            resolve();
        }, 2000);
    });
}

    </script>
</body>
</html>