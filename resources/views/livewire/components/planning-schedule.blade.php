<div class="border shadow w-fit">
    @assets @vite(['resources/js/hola.js']) @endassets

    @php
        $widthInputDays = 'w-28';
        $dateDiv = 'mt-3 w-max text-center flex-col justify-center';
    @endphp

    <div>
        <h3 class="p-2 pl-5 text-lg font-semibold">Cronograma de la Actuación Fiscal</h3>
        <hr>
    </div>
    <hr>
    <div x-data="plannigSchedule"
        x-init="@if(!isset($designation) || $isEditing) start() @else destroy() @endif"
        class="flex flex-col justify-between p-4 py-3 font-semibold"
    >
        {{-- todo planning --}}
            <x-input-date-planning
                idStart='planning_start'
                idEnd='planning_end'
                text='$wire.dates.planning_days'
                title='Planificación'
                :designation="isset($designation) && !$isEditing"
                next="execution_start"
            />
            <x-input-date-planning
                idStart='execution_start'
                idEnd='execution_end'
                text='$wire.dates.execution_days'
                title='Ejecución'
                :designation="isset($designation) && !$isEditing"
                next="preliminary_start"
            />
            <x-input-date-planning
                idStart='preliminary_start'
                idEnd='preliminary_end'
                text='$wire.dates.preliminary_days'
                title='Informe Preliminar'
                :designation="isset($designation) && !$isEditing"
                next="download_start"
            />
            <x-input-date-planning
                idStart='download_start'
                idEnd='download_end'
                text='$wire.dates.download_days'
                title='Descargo'
                :designation="isset($designation) && !$isEditing"
                next="definitive_start"
            />
            <x-input-date-planning
                idStart='definitive_start'
                idEnd='definitive_end'
                text='$wire.dates.definitive_days'
                title='Informe definitivo'
                :designation="isset($designation) && !$isEditing"
            />
    </div>
    @script
        <script>

            Alpine.data('plannigSchedule', () => {
                return {
                    formatDate: "d/m/Y",
                    excludeDaysMoment: [],
                    excludeDays: @js($excludeDays),
                    flatpickrs: [],

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
                            // || this.excludeDaysMoment.some(date => date.isSame(date, 'day'))
                            // || !date.isSame(endDate)
                        ) {
                            workingDays--;
                            date.add(1, 'days');
                            if (this.isWeekend(date)) {
                                date.add(2, 'days');
                            }
                        }

                        return date.format('DD/MM/YYYY');
                    },

                    isWeekday(date) {
                        return this.isWeekend(date)
                    },

                    isWeekend(date) {
                        return date.isoWeekday() <= 0 || date.isoWeekday() >= 6
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

                    destroy() {
                        Object.keys(this.flatpickrs).forEach(propiedad => {
                            this.flatpickrs[propiedad].destroy();
                        });
                    },

                    start() {

                            this.loadExcludeDays();

                            const config = {
                                // minDate: this.nextDay(),
                                dateFormat: this.formatDate,
                                disable: [this.filterByWeekDay],
                                locale: {
                                    // firstDayOfWeek: 1,
                                    weekdays: {
                                    shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                                    },
                                    months: {
                                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                                    longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                    },
                                },
                            }

                            const inputsDateId = [
                                "planning_start",
                                "planning_end",
                                "execution_start",
                                "execution_end",
                                "preliminary_start",
                                "preliminary_end",
                                "download_start",
                                "download_end",
                                "definitive_start",
                                "definitive_end"
                            ];

                            @can('auditActivity.show.designationAcreditation')
                            this.flatpickrs = inputsDateId.reduce((acc, current) => {
                                acc[current] = flatpickr(`#${current}`, config);
                                return acc;
                            }, {});
                            @endcan

                    },
                }
            })

        </script>
    @endscript

</div>
