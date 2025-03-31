@php
    // Formatear las fechas en el formato dd-mm-yyyy
    $fechaInicio = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->subscription));
    $fechaFin = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->delivery_uai)); // Cambia esto si quieres usar una fecha fija
    $fecha_subcripcion = date('Y-m-d', strtotime($this->auditActivity->handoverDocument->subscription)); // Formato para el valor del input date
@endphp

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff;
        color: #333;
        text-align: center;
    }

    .container {
        background-color: #e8f5e9;
        /* Color pastel */
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
        display: none;
        /* Ocultar inicialmente */
        opacity: 0;
        /* Opacidad inicial */
        transition: opacity 0.5s ease;
        /* Transición de opacidad */
    }

    .calendar-container.show {
        display: flex;
        /* Mostrar como flex */
        opacity: 1;
        /* Opacidad final */
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

    .weekend {
        background-color: #ffcccb;
    }

    .holiday {
        background-color: #ffeeba;
    }

    .working-day {
        background-color: #c3e6cb;
    }

    .selected-day {
        background-color: #007bff;
        color: white;
    }

    .result-day {
        background-color: #ff9800;
        color: white;
    }

    /* Resaltar el día del resultado */
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
        font-size: 12px;
        /* Tamaño más pequeño */
        width: 30px;
        /* Ancho más pequeño */
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


<div class="container">


    <label for="startDate">Fecha de Inicio:</label>
    <input type="date" id="startDate" value="{{ $fecha_subcripcion }}" required>

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

        document.getElementById('result').innerText =
            `Mes Seleccionado: ${monthNames[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`;

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
            if (currentDate.getDay() !== 0 && currentDate.getDay() !== 6 && !holidays.some(holiday => holiday
                    .toDateString() === currentDate.toDateString())) {
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
            if (currentDate.getDay() !== 0 && currentDate.getDay() !== 6 && !holidays.some(holiday => holiday
                    .toDateString() === currentDate.toDateString())) {
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
</script>
