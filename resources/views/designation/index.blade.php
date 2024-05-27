<x-app-layout>
	<x-section-basic>

		@php
			$widthInputDays = "w-28";
			$dateDiv = "mt-3 w-max text-center flex-col justify-center";
		@endphp

		<form
			action="{{ route("designation.download") }}"
			method="POST"
			x-data="data()"
			x-init="startPlanningStart();
init()"
		>
			@csrf
			@method("POST")

			<div>
				<template
					:key="index"
					x-for="(input, index) in Array.from({length: inputs})"
				>
					<div>
						<select
							:id="'input-' + index"
							name="auditor[]"
						>
							@foreach ($personal as $person)
								<option value="{{ $person->id }}">{{ "$person->primer_nombre $person->primer_apellido" }}</option>
							@endforeach
						</select>
						<select
							:id="'input-' + index"
							name="cargo[]"
						>
							<option value="auditor">Auditor</option>
							<option value="coordinador">Coordinador</option>
						</select>
					</div>
				</template>
				<div
					class="flex w-6/12 flex-col items-center justify-center"
					style="width: 50%!important"
				>
					<div
						class="!z-5 shadow-3xl shadow-shadow-500 3xl:p-![18px] undefined relative flex flex w-full max-w-[300px] flex-col flex-col rounded-[20px] bg-white bg-white bg-clip-border !p-6 md:max-w-[400px]"
					>
						<div class="mb-3 flex flex-col">
							<button
								@click.prevent="addInput"
								class="rounded-l bg-gray-300 px-4 py-2 font-bold text-gray-800 hover:bg-gray-400"
							>
								+
							</button>
							<button
								@click.prevent="removeInput"
								class="rounded-r bg-gray-300 px-4 py-2 font-bold text-gray-800 hover:bg-gray-400"
							>
								-
							</button>
							<button
								class="select-none rounded-lg bg-gray-900 px-6 py-3 text-center align-middle font-sans text-xs font-bold uppercase shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
								type="submit"
							>
								Button
							</button>
						</div>
					</div>
				</div>
			</div>

			<div class="mt-20 text-center">
				<lable class="text-lg font-semibold">Fecha de Inicio de la Auditoria:</lable> <br>
				<input
					class="datepicker w-56 rounded border-2 border-gray-300 px-3 py-2"
					placeholder="04/04/2024"
					type="text"
					x-model="planningStart"
				>
			</div>
			<div class="flex flex-row justify-between">

				<div class="{{ $dateDiv }}">
					<div>
						<span>Fecha de Planificacion:</span>
					</div>
					<label for="">N° dias: </label>
					<input
						class="{{ $widthInputDays }} rounded border-2 border-gray-300 px-3 py-2"
						id="planningDays"
						name="planningDays"
						type="number"
						x-model="planningDays"
						x-on:input="planningEnd = calculateDays(
              planningStart instanceof Date 
                ? formatDateToVzlFormat(planningStart) 
                : typeof planningStart === 'string' 
                  ? formatDateToUsaFormat(planningStart)
                  : null
              , cleanText(planningDays)
              )"
					>
					<div>
						<span
							class=""
							x-text="planningStart"
						></span> - <span x-text="planningEnd"></span>
						<input
							class="datepicker"
							id="planningStart"
							name="planningStart"
							style="display: none"
							type="date"
							x-model="planningStart"
						>
						<input
							class="datepicker"
							id="planningEnd"
							name="planningEnd"
							style="display: none"
							type="date"
							x-model="planningEnd"
						>
					</div>
				</div>

				<div class="{{ $dateDiv }}">
					<div>
						<span>Fecha de Ejecucion:</span>
					</div>
					<label for="">N° dias: </label>
					<input
						class="{{ $widthInputDays }} rounded border-2 border-gray-300 px-3 py-2"
						id="executionDays"
						name="executionDays"
						type="number"
						x-model="executionDays"
						x-on:input="executionEnd = calculateDays(
              planningEnd instanceof Date 
                ? formatDateToVzlFormat(planningEnd) 
                : typeof planningEnd === 'string' 
                  ? formatDateToUsaFormat(planningEnd)
                  : null
              , cleanText(executionDays)+1
              )"
					>
					<div>
						<span x-text="executionStart = calculateDays(formatDateToUsaFormat(planningEnd))"></span> - <span
							x-text="executionEnd"
						></span>
						<input
							class="datepicker"
							id="executionStart"
							name="executionStart"
							style="display: none"
							type="date"
							x-model="executionStart"
						>
						<input
							class="datepicker"
							id="executionEnd"
							name="executionEnd"
							style="display: none"
							type="date"
							x-model="executionEnd"
						>
					</div>
				</div>

				<div class="{{ $dateDiv }}">
					<div>
						<span>Fecha de Informe Preeliminar:</span>
					</div>
					<label for="">N° dias: </label>
					<input
						class="{{ $widthInputDays }} rounded border-2 border-gray-300 px-3 py-2"
						id="preliminaryDays"
						name="preliminaryDays"
						type="number"
						x-model="preliminaryDays"
						x-on:input="preliminaryEnd = calculateDays(
              executionEnd instanceof Date 
                ? formatDateToVzlFormat(executionEnd) 
                : typeof executionEnd === 'string' 
                  ? formatDateToUsaFormat(executionEnd)
                  : null
              , cleanText(preliminaryDays)+1)"
					>
					<div>
						<span x-text="preliminaryStart = calculateDays(formatDateToUsaFormat(executionEnd))"></span> -
						<span x-text="preliminaryEnd"></span>
						<input
							class="datepicker"
							id="preliminaryStart"
							name="preliminaryStart"
							style="display: none"
							type="date"
							x-model="preliminaryStart"
						>
						<input
							class="datepicker"
							id="preliminaryEnd"
							name="preliminaryEnd"
							style="display: none"
							type="date"
							x-model="preliminaryEnd"
						>
					</div>
				</div>

				<div class="{{ $dateDiv }}">
					<div>
						<div>
							<span>Fecha de Descargo:</span>
						</div>
						<label for="">N° dias: </label>
						<input
							class="{{ $widthInputDays }} rounded border-2 border-gray-300 px-3 py-2"
							id="downloadDays"
							name="downloadDays"
							type="number"
							x-model="downloadDays"
							x-on:input="downloadEnd = calculateDays(
              preliminaryEnd instanceof Date 
                ? formatDateToVzlFormat(preliminaryEnd) 
                : typeof preliminaryEnd === 'string' 
                  ? formatDateToUsaFormat(preliminaryEnd)
                  : null
              , cleanText(downloadDays)+1)"
						>
						<div>
							<span x-text="downloadStart = calculateDays(formatDateToUsaFormat(preliminaryEnd))"></span> - <span
								x-text="downloadEnd"
							></span>
							<input
								class="datepicker"
								id="downloadStart"
								name="downloadStart"
								style="display: none"
								type="date"
								x-model="downloadStart"
							>
							<input
								class="datepicker"
								id="downloadEnd"
								name="downloadEnd"
								style="display: none"
								type="date"
								x-model="downloadEnd"
							>
						</div>
					</div>
				</div>

				<div class="{{ $dateDiv }}">
					<div>
						<span>Fecha de Informe Definitivo:</span>
					</div>
					<label for="">N° dias: </label>
					<input
						class="{{ $widthInputDays }} rounded border-2 border-gray-300 px-3 py-2"
						id="definitiveDays"
						name="definitiveDays"
						type="number"
						x-model="definitiveDays"
						x-on:input="definitiveEnd = calculateDays(
              downloadEnd instanceof Date 
                ? formatDateToVzlFormat(downloadEnd) 
                : typeof downloadEnd === 'string' 
                  ? formatDateToUsaFormat(downloadEnd)
                  : null
              , cleanText(definitiveDays)+1)"
					>
					<div>
						<span x-text="definitiveStart = calculateDays(formatDateToUsaFormat(downloadEnd))"></span> - <span
							x-text="definitiveEnd"
						></span>
						<input
							class="datepicker"
							id="definitiveStart"
							name="definitiveStart"
							style="display: none"
							type="date"
							x-model="definitiveStart"
						>
						<input
							class="datepicker"
							id="definitiveEnd"
							name="definitiveEnd"
							style="display: none"
							type="date"
							x-model="definitiveEnd"
						>
					</div>
				</div>
			</div>
		</form>

		{{-- todo flatpickr script --}}
		<script>
			flatpickr(".datepicker", {
				dateFormat: "d/m/Y",
			});
		</script>

		{{-- todo add Auditor --}}
		<script>
			function data() {
				return {
					inputs: 1,
					planningStart: new Date(),
					planningEnd: null,
					planningDays: 5,
					executionStart: null,
					executionEnd: null,
					executionDays: 10,
					preliminaryStart: null,
					preliminaryEnd: null,
					preliminaryDays: 10,
					downloadStart: null,
					downloadEnd: null,
					downloadDays: 10,
					definitiveStart: null,
					definitiveEnd: null,
					definitiveDays: 5,

					optionsDate: {
						day: '2-digit',
						month: '2-digit',
						year: 'numeric',
					},

					startPlanningStart() {
						this.planningStart = this.planningStart.toLocaleDateString('es-vz', this.optionsDate)
					},

					isWeekEnd(date) {
						return date.getDay() === 0 || date.getDay() === 6
					},

					cleanText(text) {
						return Number(text.split(" ")[0])
					},

					calculateDays(date, days = 1) {
						if (date === null) {
							return null
						}
						date = new Date(date)
						date.setDate(date.getDate() + 1)

						while (days > 0 || this.isWeekEnd(date)) {
							date.setDate(date.getDate() + 1)

							if (this.isWeekEnd(date)) {
								date.setDate(date.getDate() + 2)
							}

							days--
						}
						return this.formatDateToVzlFormat(date)
					},

					formatDateToUsaFormat(date) {
						if (date === null) {
							return null;
						}

						[day, month, year] = date.split("/")
						return `${year}-${month}-${day}`
					},

					formatDateToVzlFormat(date) {
						return date.toLocaleDateString('es', this.optionsDate)
					},

					init() {
						this.planningEnd = this.calculateDays(this.formatDateToUsaFormat(this.planningStart), this.planningDays);
						this.executionEnd = this.calculateDays(this.formatDateToUsaFormat(this.planningEnd), this.executionDays);
						this.preliminaryEnd = this.calculateDays(this.formatDateToUsaFormat(this.executionEnd), this
							.preliminaryDays);
						this.downloadEnd = this.calculateDays(this.formatDateToUsaFormat(this.preliminaryEnd), this.downloadDays);
						this.definitiveEnd = this.calculateDays(this.formatDateToUsaFormat(this.downloadEnd), this.definitiveDays);
					},

					addInput() {
						this.inputs++;
					},

					removeInput() {
						if (this.inputs > 1) {
							this.inputs--;
						}
					}
				}
			}
		</script>
	</x-section-basic>
</x-app-layout>
