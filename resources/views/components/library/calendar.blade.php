<!-- component -->
	<div class="mx-auto p-4 sm:w-10/12 md:w-9/12 lg:w-7/12">
		<div class="overflow-hidden rounded-lg bg-white shadow-lg">
			<div class="flex items-center justify-between bg-gray-700 px-6 py-3">
				<button
					class="text-white"
					id="prevMonth"
				>Anterior</button>
				<h2
					class="text-white"
					id="currentMonth"
				></h2>
				<button
					class="text-white"
					id="nextMonth"
				>Siguiente</button>
			</div>
			<div
				class="grid grid-cols-7 gap-2 p-4"
				id="calendar"
			>
				<!-- Calendar Days Go Here -->
			</div>
			<div
				class="modal fixed inset-0 z-50 flex hidden items-center justify-center"
				id="myModal"
			>
				<div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

				<div class="modal-container z-50 mx-auto w-11/12 overflow-y-auto rounded bg-white shadow-lg md:max-w-md">
					<div class="modal-content px-6 py-4 text-left">
						<div class="flex items-center justify-between pb-3">
							<p class="text-2xl font-bold">Selecionar fecha</p>
							<button
								class="modal-close rounded-full bg-gray-200 px-3 py-1 hover:bg-gray-300 focus:outline-none focus:ring"
								id="closeModal"
							>✕</button>
						</div>
						<div
							class="text-xl font-semibold"
							id="modalDate"
						></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	// {{-- todo Function to generate the calendar for a specific month and year 
	function generateCalendar(year, month) {
		const calendarElement = document.getElementById('calendar');
		const currentMonthElement = document.getElementById('currentMonth');

		//{{-- todo Create a date object for the first day of the specified month 
		const firstDayOfMonth = new Date(year, month, 1);
		const daysInMonth = new Date(year, month + 1, 0).getDate();

		//{{-- todo Clear the calendar 
		calendarElement.innerHTML = '';

		//{{-- todo Set the current month text 
		const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
		];
		currentMonthElement.innerText = `${monthNames[month]} ${year}`;

		//{{-- todo Calculate the day of the week for the first day of the month (0 - Sunday, 1 - Monday, ..., 6 - Saturday) 
		const firstDayOfWeek = firstDayOfMonth.getDay();

		//{{-- todo Create headers for the days of the week 
		const daysOfWeek = ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'];
  
		daysOfWeek.forEach(day => {
			const dayElement = document.createElement('div');
			dayElement.className = 'text-center font-semibold';
			dayElement.innerText = day;
			calendarElement.appendChild(dayElement);
		});

		//{{-- todo Create empty boxes for days before the first day of the month 
		for (let i = 0; i < firstDayOfWeek; i++) {
			const emptyDayElement = document.createElement('div');
			calendarElement.appendChild(emptyDayElement);
		}

		//{{-- todo Create boxes for each day of the month 
		for (let day = 1; day <= daysInMonth; day++) {
			const dayElement = document.createElement('div');
			dayElement.className = 'text-center py-2 border cursor-pointer';
			dayElement.innerText = day;

			//{{-- todo Check if this date is the current date 
			const currentDate = new Date();
			if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
				dayElement.classList.add('bg-blue-500', 'text-white'); //{{-- todo Add classes for the indicator 
			}

			calendarElement.appendChild(dayElement);
		}
	}

	//{{-- todo Initialize the calendar with the current month and year 
	const currentDate = new Date();
	let currentYear = currentDate.getFullYear();
	let currentMonth = currentDate.getMonth();
	generateCalendar(currentYear, currentMonth);

	//{{-- todo Event listeners for previous and next month buttons 
	document.getElementById('prevMonth').addEventListener('click', () => {
		currentMonth--;
		if (currentMonth < 0) {
			currentMonth = 11;
			currentYear--;
		}
		generateCalendar(currentYear, currentMonth);
	});

	document.getElementById('nextMonth').addEventListener('click', () => {
		currentMonth++;
		if (currentMonth > 11) {
			currentMonth = 0;
			currentYear++;
		}
		generateCalendar(currentYear, currentMonth);
	});

	//{{-- todo Function to show the modal with the selected date 
	function showModal(selectedDate) {
		const modal = document.getElementById('myModal');
		const modalDateElement = document.getElementById('modalDate');
		modalDateElement.innerText = selectedDate;
		modal.classList.remove('hidden');
	}

	//{{-- todo Function to hide the modal 
	function hideModal() {
		const modal = document.getElementById('myModal');
		modal.classList.add('hidden');
	}

	//{{-- todo Event listener for date click events 
	const dayElements = document.querySelectorAll('.cursor-pointer');
	dayElements.forEach(dayElement => {
		dayElement.addEventListener('click', () => {
			const day = parseInt(dayElement.innerText);
			const selectedDate = new Date(currentYear, currentMonth, day);
			const options = {
				weekday: 'long',
				year: 'numeric',
				month: 'long',
				day: 'numeric'
			};
			const formattedDate = selectedDate.toLocaleDateString(undefined, options);
			showModal(formattedDate);
		});
	});

	//{{-- todo Event listener for closing the modal 
	document.getElementById('closeModal').addEventListener('click', () => {
		hideModal();
	});
</script>
