<x-section-basic x-data="data()" x-init="init()">

    @php
        $widthInputDays = 'w-28';
        $dateDiv = 'mt-3 w-max text-center flex-col justify-center';
    @endphp

    <div>
        <div>
            <h3 class="font-semibold text-lg">Cronograma de la Actuacion Fiscal</h3>
            <hr>
        </div>
        <div>
            {{-- todo planning --}}
            <div>
                <span>Planificacion:</span>
                <div class="flex flex-row items-center justify-evenly bg-slate-300 h-20 w-3/6 border rounded-md px-2">
                    <x-input class="h-12" id="planningStart" placeholder="Inicio.." x-model="planningStart" wire:model='schedule.planning_start' readonly/> 
                    -
                    <x-input class="h-12" id="planningEnd" placeholder="Fin.." x-model="planningEnd" wire:model='schedule.planning_end' readonly/>
                    <x-input-increment livewire="planning_days" alpine='planningDays'></x-input-increment>
                </div>
            </div>

            {{-- todo execution --}}
            <div>
                <span>Ejecucion:</span>
                <div class="flex flex-row items-center justify-evenly bg-slate-300 h-20 w-3/6 border rounded-md px-2">
                    <x-input id="executionStart " placeholder="Inicio.." x-model="executionStart" wire:model='schedule.execution_start' readonly/>
                    -
                    <x-input id="executionEnd " placeholder="Fin.." x-model="executionEnd" wire:model='schedule.execution_end' readonly/>
                    <x-input-increment livewire="execution_days"  alpine='executionDays'></x-input-increment>
                </div>

            </div>

            {{-- todo preliminary --}}
            <div>
                <span>Informe Preliminar</span>
                <div class="flex flex-row items-center justify-evenly bg-slate-300 h-20 w-3/6 border rounded-md px-2">
                    <x-input id="preliminaryStart " placeholder="Inicio.." x-model="preliminaryStart" wire:model='schedule.preliminary_start' readonly/>
                    -
                    <x-input id="preliminaryEnd " placeholder="Fin.." x-model="preliminaryEnd" wire:model='schedule.preliminary_end' readonly/>
                    <x-input-increment livewire="preliminary_days" alpine='preliminaryDays'></x-input-increment>
                </div>
            </div>

            {{-- todo download --}}
            <div>
                <span>Descargo:</span>
                <div class="flex flex-row items-center justify-evenly bg-slate-300 h-20 w-3/6 border rounded-md px-2">
                    <x-input id="downloadStart " placeholder="Inicio.." x-model="downloadStart" wire:model='schedule.download_start' readonly/>
                    -
                    <x-input id="downloadEnd " placeholder="Fin.." x-model="downloadEnd" wire:model='schedule.download_end' readonly/>
                    <x-input-increment livewire="download_days" alpine='downloadDays'></x-input-increment>
                </div>
            </div>

            {{-- todo definitive --}}
            <div>
                <span>Informe definitivo</span>
                <div class="flex flex-row items-center justify-evenly bg-slate-300 h-20 w-3/6 border rounded-md px-2">
                    <x-input id="definitiveStart " placeholder="Inicio.." x-model="definitiveStart" wire:model='schedule.definitive_start' readonly/>
                    -
                    <x-input id="definitiveEnd " placeholder="Fin.." x-model="definitiveEnd" wire:model='schedule.definitive_end' readonly/>
                    <x-input-increment livewire="definitive_days" alpine='definitiveDays'></x-input-increment>
                </div>
            </div>
        </div>
    </div>

    <script>
        function data() {
            return {
                formatDate: "d/m/Y", 
                planningStart: null,
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
                init() {

                    // {{-- todo planning
                    flatpickr("#planningStart", {
                        minDate: "today",
                        dateFormat: this.formatDate,
                    });

                    flatpickr("#planningEnd", {
                        dateFormat: this.formatDate,
                    });


                    // {{-- todo execution 
                    flatpickr("#executionStart", {
                        dateFormat: this.formatDate,
                    });

                    flatpickr("#executionEnd", {
                        dateFormat: this.formatDate,
                    })


                    // {{-- todo preliminary 
                    flatpickr("#preliminaryStart", {
                        dateFormat: this.formatDate,
                    });

                    flatpickr("#preliminaryEnd", {
                        dateFormat: this.formatDate,
                    });

                    
                    // {{-- todo download 
                    flatpickr("#downloadStart", {
                        dateFormat: this.formatDate,
                    });

                    flatpickr("#downloadEnd", {
                        dateFormat: this.formatDate,
                    });


                    // {{-- todo definitive 
                    flatpickr("#definitiveStart", {
                        dateFormat: this.formatDate,
                    });

                    flatpickr("#definitiveEnd", {
                        dateFormat: this.formatDate,
                    });
                },
            }
        }
    </script>
    </x-section-basic>