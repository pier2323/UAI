<div>

    @php
        $excludeDays = ['2024-08-28', '2024-08-29'];
    @endphp

    @assets
    @vite(['resources/js/hola.js']) 
    @endassets

    @php
        $widthInputDays = 'w-28';
        $dateDiv = 'mt-3 w-max text-center flex-col justify-center';
    @endphp

    <div x-data="plannigSchedule">
        <div>
            <h3 class="text-lg font-semibold">Cronograma de la Actuacion Fiscal</h3>
            <hr>
        </div>
        <div>
            
            {{-- todo planning --}}
            <div>
                <span>Planificacion:</span>
                <div class="flex flex-row items-center w-3/6 h-20 px-2 border rounded-md justify-evenly bg-slate-300">
                    <x-input 
                        class="h-12" 
                        id="planningStart" 
                        placeholder="Inicio.." 
                        x-on:input="$wire.planning_days = calculateDays($wire.planning_start, $wire.planning_end)" 
                        x-model="$wire.planning_start" 
                        wire:model='planning_start' 
                        readonly
                    /> 
                    -
                    <x-input 
                        class="h-12" 
                        id="planningEnd" 
                        x-on:input="$wire.planning_days = calculateDays($wire.planning_start, $wire.planning_end)"  
                        placeholder="Fin.." 
                        x-model="$wire.planning_end" 
                        wire:model='planning_end' 
                        readonly
                    />
                    <div>
                        <span x-text="$wire.planning_days"></span>
                    </div>
                </div>
            </div>

            {{-- todo execution --}}
            {{-- <div>
                <span>Ejecucion:</span>
                <div class="flex flex-row items-center w-3/6 h-20 px-2 border rounded-md justify-evenly bg-slate-300">
                    <x-input id="executionStart " placeholder="Inicio.." x-on:input="execution()" x-model="$wire.execution_start" wire:model='execution_start' readonly/>
                    -
                    <x-input id="executionEnd " placeholder="Fin.."  x-on:input="execution()"  x-model="$wire.execution_end" wire:model='execution_end' readonly/>
                    <x-input-increment livewire="execution_days" alpine='$wire.execution_days'></x-input-increment>
                </div>

            </div> --}}

            {{-- todo preliminary --}}
            {{-- <div>
                <span>Informe Preliminar</span>
                <div class="flex flex-row items-center w-3/6 h-20 px-2 border rounded-md justify-evenly bg-slate-300">
                    <x-input id="preliminaryStart " placeholder="Inicio.." x-on:input="preliminary()" x-model="$wire.preliminary_start" wire:model='preliminary_start' readonly/>
                    -
                    <x-input id="preliminaryEnd " placeholder="Fin.." x-on:input="preliminary()" x-model="$wire.preliminary_end" wire:model='preliminary_end' readonly/>
                    <x-input-increment livewire="preliminary_days" alpine='$wire.preliminary_days'></x-input-increment>
                </div>
            </div> --}}

            {{-- todo download --}}
            {{-- <div>
                <span>Descargo:</span>
                <div class="flex flex-row items-center w-3/6 h-20 px-2 border rounded-md justify-evenly bg-slate-300">
                    <x-input id="downloadStart " placeholder="Inicio.." x-on:input="download()" x-model="$wire.download_start" wire:model='download_start' readonly/>
                    -
                    <x-input id="downloadEnd " placeholder="Fin.." x-on:input="download()" x-model="$wire.download_end" wire:model='download_end' readonly/>
                    <x-input-increment livewire="download_days" alpine='$wire.download_days'></x-input-increment>
                </div>
            </div> --}}

            {{-- todo definitive --}}
            {{-- <div>
                <span>Informe definitivo</span>
                <div class="flex flex-row items-center w-3/6 h-20 px-2 border rounded-md justify-evenly bg-slate-300">
                    <x-input id="definitiveStart " placeholder="Inicio.." x-on:input="definitive()" x-model="$wire.definitive_start" wire:model='definitive_start' readonly/>
                    -
                    <x-input id="definitiveEnd " placeholder="Fin.." x-on:input="definitive()" x-model="$wire.definitive_end" wire:model='definitive_end' readonly/>
                    <x-input-increment livewire="definitive_days" alpine='$wire.definitive_days'></x-input-increment>
                </div>
            </div> --}}
        </div>
    </div>

    @script
<script>
        
Alpine.data('plannigSchedule', () => {
    return {
        formatDate: "d/m/Y", 
        excludeDaysMoment: [],
        excludeDays: @js($excludeDays),
                       
        calculateDays(start = '13/12/2024', end = "13/12/2024") {
            const format = 'DD-MM-YYYY';
            let workingDays = 0;
            console.log(start);
            
            const firstDate = moment(start, format);
            const endDate = moment(end, format);

            while (firstDate.isSameOrBefore(endDate)) {
                if (
                    firstDate.isoWeekday() >= 1
                    && firstDate.isoWeekday() <= 5
                    && !firstDate.isSame(endDate)
                    && !this.excludeDaysMoment.some(date => firstDate.isSame(date, 'day'))
                ) {
                    workingDays++;
                }
                firstDate.add(1, 'days');
            }

            return workingDays;
        },
        
        loadExcludeDays() {
            for (const date of this.excludeDays) {
                this.excludeDaysMoment.push(moment(date))
            }
        },

        filterByWeekDay(date) {
            return (date.getDay() === 0 || date.getDay() === 6)
        },

        nextDay() {
            const oneDay = 24 * 60 * 60 * 1000;
            const now = new Date();
            return new Date(now.getTime() + oneDay); 
        },

        init() {
            this.loadExcludeDays();
            
            const config = {
                minDate: this.nextDay(),
                dateFormat: this.formatDate,
                disable: [this.filterByWeekDay]
            }

            const inputsDateId = [
                "#planningStart",
                "#planningEnd",
                // "#executionStart",
                // "#executionEnd",
                // "#preliminaryStart",
                // "#preliminaryEnd",
                // "#downloadStart",
                // "#downloadEnd",
                // "#definitiveStart",
                // "#definitiveEnd"
            ];
            
            for (const id of inputsDateId) { flatpickr(id, config); }
        },
    }
})


    </script>
    @endscript
  
</div>
