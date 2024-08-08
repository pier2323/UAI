<x-section-basic>

    @vite(['resources/js/hola.js'])

    @php
        $widthInputDays = 'w-28';
        $dateDiv = 'mt-3 w-max text-center flex-col justify-center';
    @endphp
    <lable class="text-lg font-semibold" style="margin-left: 450px;"> Selecione la comicion de auditoria </lable>


    <div class="mt-20 text-center">
        <lable class="text-lg font-semibold">Fecha de Inicio de la Auditoria:</lable> <br>
        <input 
            class="w-56 rounded border-2 border-gray-300 px-3 py-2" 
            placeholder="04/04/2024"
            type="date" 
            x-model="planningStart"
        >
    </div>

    
    <div     
        class="flex flex-row justify-between"
        x-data="data()" 
        x-init="startPlanningStart(); init()"
    >
        <div class="{{ $dateDiv }}">
            <div>
                <span>Fecha de Planificacion:</span>
            </div>
            <label for="">N° dias: </label>
            <input 
                id="planningDays"
                class="{{ $widthInputDays }} rounded border-2 border-gray-300 px-3 py-2" 
                name="planningDays" 
                type="number" 
                wire:model='schedule.planningDays'
                x-model="planningDays"
                x-on:input="
                    planningEnd = calculateDays(planningStart instanceof Date 
                    ? formatDateToVzlFormat(planningStart) 
                    : typeof planningStart === 'string' 
                    ? formatDateToUsaFormat(planningStart)
                    : null
                    , cleanText(planningDays));
                    $wire.planningDays = planningDays"
                >
            <div>
                <span class="" x-text="planningStart"></span> - <span x-text="planningEnd"></span>
            </div>
        </div>

        <div class="{{ $dateDiv }}">
            <div>
                <span>Fecha de Ejecucion:</span>
            </div>
            <label for="">N° dias: </label>
            <input 
                class="{{ $widthInputDays }} rounded border-2 border-gray-300 px-3 py-2" id="executionDays"
                name="executionDays" 
                type="number" 
                wire:model='schedule.executionDays'
                x-model="executionDays"
                x-on:input="executionEnd = calculateDays(
                    planningEnd instanceof Date 
                        ? formatDateToVzlFormat(planningEnd) 
                        : typeof planningEnd === 'string' 
                        ? formatDateToUsaFormat(planningEnd)
                        : null
                    , cleanText(executionDays)+1);
                    $wire.preliminaryEnd = preliminaryEnd"
                >
            <div>
                <span x-text="executionStart = calculateDays(formatDateToUsaFormat(planningEnd))"></span> - <span x-text="executionEnd"></span>
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
                wire:model='schedule.preliminaryDays' 
                x-model="preliminaryDays"
                x-on:input="preliminaryEnd = calculateDays(
                executionEnd instanceof Date 
                    ? formatDateToVzlFormat(executionEnd) 
                    : typeof executionEnd === 'string' 
                    ? formatDateToUsaFormat(executionEnd)
                    : null
                , cleanText(preliminaryDays)+1);
                $wire.preliminaryEnd = preliminaryEnd
                "
            >
            <div>
                <span x-text="preliminaryStart = calculateDays(formatDateToUsaFormat(executionEnd))"></span> - <span x-text="preliminaryEnd"></span>
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
                    wire:model='schedule.downloadDays'
                    x-model="downloadDays"
                    x-on:input="downloadEnd = calculateDays(
                    preliminaryEnd instanceof Date 
                        ? formatDateToVzlFormat(preliminaryEnd) 
                        : typeof preliminaryEnd === 'string' 
                        ? formatDateToUsaFormat(preliminaryEnd)
                        : null
                    , cleanText(downloadDays)+1);
                    $wire.downloadEnd = downloadEnd
                    "
                    >
                <div>
                    <span x-text="downloadStart = calculateDays(formatDateToUsaFormat(preliminaryEnd))"></span> - <span x-text="downloadEnd"></span>
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
                wire:model='schedule.definitiveDays'
                x-model="definitiveDays"
                x-on:input="definitiveEnd = calculateDays(
                downloadEnd instanceof Date 
                    ? formatDateToVzlFormat(downloadEnd) 
                    : typeof downloadEnd === 'string' 
                    ? formatDateToUsaFormat(downloadEnd)
                    : null
                , cleanText(definitiveDays)+1);
                $wire.definitiveEnd = definitiveEnd
                "
            >
            <div>
                <span x-text="definitiveStart = calculateDays(formatDateToUsaFormat(downloadEnd))"></span> - <span x-text="definitiveEnd"></span>
            </div>
        </div>
    </div>

    <script>
        function data() {
            return {
                planningStart: new Date(),
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
                    this.preliminaryEnd = this.calculateDays(this.formatDateToUsaFormat(this.executionEnd), this.preliminaryDays);
                    this.downloadEnd = this.calculateDays(this.formatDateToUsaFormat(this.preliminaryEnd), this.downloadDays);
                    this.definitiveEnd = this.calculateDays(this.formatDateToUsaFormat(this.downloadEnd), this.definitiveDays);
                },
            }
        }
    </script>
    </x-section-basic>