<div>
    <h2>Calendario</h2>
    
    <label for="startDate">Fecha de Inicio:</label>
    <input type="text" id="startDate" value="{{ $startDate }}" readonly />
    
    <label for="endDate">Fecha de Fin (120 días):</label>
    <input type="text" id="endDate" value="{{ $endDate }}" readonly />

    <div>
        <label for="yearSelector">Seleccionar Año:</label>
        <select id="yearSelector"></select>

        <label for="monthSelector">Seleccionar Mes:</label>
        <select id="monthSelector"></select>
    </div>

    <div id="calendar"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const startDate = new Date("{{ $startDate }}"); // Usar el formato 'd-m-Y'
            const endDate = new Date("{{ $endDate }}"); // Usar el formato 'd-m-Y'
            const calendarContainer = document.getElementById('calendar');
            const yearSelector = document.getElementById('yearSelector');
            const monthSelector = document.getElementById('monthSelector');

            // Rango de años
            const yearRange = [...Array(9).keys()].map(i => 2022 + i); // 2022 a 2030
            yearRange.forEach(year => {
                const option = document.createElement('option');
                option.value = year;
                option.text = year;
                yearSelector.appendChild(option);
            });

            // Rango de meses
            const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            monthNames.forEach((month, index) => {
                const option = document.createElement('option');
                option.value = index;
                option.text = month;
                monthSelector.appendChild(option);
            });

            // Función para mostrar el calendario
            function renderCalendar(year, month) {
                calendarContainer.innerHTML = ''; // Limpiar el calendario
                const monthDiv = document.createElement('div');
                monthDiv.style.display = 'inline-block';
                monthDiv.style.width = '150px';
                monthDiv.style.border = '1px solid #ccc';
                monthDiv.style.margin = '5px';
                monthDiv.innerHTML = `<strong>${monthNames[month]} ${year}</strong><br>`;

                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const firstDay = new Date(year, month, 1).getDay();

                // Crear un espacio para los días del mes
                for (let i = 0; i < firstDay; i++) {
                    monthDiv.innerHTML += `<span></span>`; // Espacios en blanco
                }

                // Agregar los días del mes
                for (let day = 1; day <= daysInMonth; day++) {
                    const currentDate = new Date(year, month, day);
                    const isInRange = currentDate >= startDate && currentDate <= endDate;

                    const daySpan = document.createElement('span');
                    daySpan.textContent = day;
                    daySpan.style.display = 'inline-block';
                    daySpan.style.width = '20px';
                    daySpan.style.textAlign = 'center';
                    daySpan.style.margin = '2px';
                    
                    // Resaltar los días dentro del rango
                    if (isInRange) {
                        daySpan.style.backgroundColor = '#d1e7dd'; // Color de fondo para el rango
                    }

                    monthDiv.appendChild(daySpan);
                }

                calendarContainer.appendChild(monthDiv);
            }

            // Renderizar el calendario por defecto
            const currentYear = startDate.getFullYear();
            const currentMonth = startDate.getMonth();
            renderCalendar(currentYear, currentMonth);

            // Eventos para cambiar año y mes
            yearSelector.addEventListener('change', function() {
                renderCalendar(this.value, monthSelector.value);
            });

            monthSelector.addEventListener('change', function() {
                renderCalendar(yearSelector.value, this.value);
            });
        });
    </script>
</div>