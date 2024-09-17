<div class="border shadow w-fit">
    @assets @vite(['resources/js/hola.js']) @endassets

    @php
        $widthInputDays = 'w-28';
        $dateDiv = 'mt-3 w-max text-center flex-col justify-center';
    @endphp

    <div>
        <h3 class="p-2 pl-5 text-lg font-semibold">Cronograma de la Actuacion Fiscal</h3>
        <hr>
    </div>
    <hr>
    <div x-data="plannigSchedule" class="flex flex-col justify-between p-4 py-3 font-semibold">
        {{-- todo planning --}}
            <x-input-date-planning
                idStart='planning_start' 
                idEnd='planning_end' 
                text='$wire.planning_days'
                title='Planificacion'
                :designation="isset($designation)"
            />
            <x-input-date-planning
                idStart='execution_start' 
                idEnd='execution_end' 
                text='$wire.execution_days' 
                title='Ejecucion'
                :designation="isset($designation)"
            />
            <x-input-date-planning
                idStart='preliminary_start' 
                idEnd='preliminary_end' 
                text='$wire.preliminary_days' 
                title='Informe Preliminar'
                :designation="isset($designation)"
            />
            <x-input-date-planning
                idStart='download_start' 
                idEnd='download_end' 
                text='$wire.download_days' 
                title='Descargo'
                :designation="isset($designation)"
            />
            <x-input-date-planning
                idStart='definitive_start' 
                idEnd='definitive_end' 
                text='$wire.definitive_days' 
                title='Informe definitivo'
                :designation="isset($designation)"
            />
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
                        let workingDays = 1;
                        
                        const firstDate = moment(start, format);
                        const endDate = moment(end, format);

                        while (firstDate.isSameOrBefore(endDate)) {
                            if (
                                firstDate.isoWeekday() >= 1
                                && firstDate.isoWeekday() <= 5
                                && !firstDate.isSame(endDate)
                                && !this.excludeDaysMoment.some(date => firstDate.isSame(date, 'day'))
                            ) 

                            { workingDays++ }

                            firstDate.add(1, 'days');
                        }

                        return workingDays;
                    },

                    calculateDates(start = '13/12/2024', workingDays = 5) {                        
                        const date = moment(start, 'DD-MM-YYYY');

                        while (
                            workingDays > 1 
                            || date.isoWeekday() <= 0 
                            || date.isoWeekday() >= 6
                            // || this.excludeDaysMoment.some(date => date.isSame(date, 'day'))
                            // || !date.isSame(endDate)
                        ) { 
                            date.add(1, 'days'); 
                            console.log(workingDays--); 
                        }

                        return date.format('DD/MM/YYYY');
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
                        @empty($designation)

                            this.loadExcludeDays();
                            
                            const config = {
                                // minDate: this.nextDay(),
                                dateFormat: this.formatDate,
                                disable: [this.filterByWeekDay]
                            }

                            const inputsDateId = [
                                "#planning_start",
                                "#planning_end",
                                "#execution_start",
                                "#execution_end",
                                "#preliminary_start",
                                "#preliminary_end",
                                "#download_start",
                                "#download_end",
                                "#definitive_start",
                                "#definitive_end"
                            ];
                            
                            for (const id of inputsDateId) { flatpickr(id, config); }
                            
                        @endempty
                    },
                }
            })

        </script>
    @endscript
  
</div>
