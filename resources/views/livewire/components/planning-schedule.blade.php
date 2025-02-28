<?php

use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\NotWorkingDays;
use App\Models\TypeAudit;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;

new class extends \Livewire\Volt\Component
{
    #[Reactive]
    public bool $isEditing = false;

    #[Modelable]
    public object $dates;

    #[Locked]
    public $excludeDays;

    #[Reactive]
    public AuditActivity $auditActivity;

    #[Reactive]
    public bool $designation;

    public Acreditation|null $acreditation;

    public TypeAudit $typeAudit;

    #[Reactive]
    public ?array $errors;

    public function mount()
    {
        $this->excludeDays = NotWorkingDays::pluck('day');
    }
};

?>

@php
    $widthInputDays = 'w-28';
    $dateDiv = 'mt-3 w-max text-center flex-col justify-center';
@endphp

<div class="border shadow w-fit">
    @assets @vite(['resources/js/hola.js']) @endassets
    <div>
        <h3 class="p-2 pl-5 text-lg font-semibold">Cronograma de la Actuación Fiscal</h3>
        <hr>
    </div>
    <hr>
    <div x-data="plannigSchedule"
        x-init="@if(!$designation || $isEditing) start() @else destroy() @endif"
        x-on:deleted.window="start()"
        class="flex flex-col justify-between p-4 py-3 font-semibold"
        :class="typeof $wire.errors[0] !== 'undefined' ? 'border-red-400' : ''"
    >
        {{-- todo planning --}}
            <x-input-date-planning
                idStart='planning_start'
                idEnd='planning_end'
                text='$wire.dates.planning_days'
                title='Planificación'
                :designation="$designation && !$isEditing"
                next="execution_start"
            />
            {{-- ? conditions about typeAudits for planningSchedule --}}
            @if($typeAudit->code !== 'as' and $typeAudit->code !== 'ae')
                <x-input-date-planning
                    idStart='execution_start'
                    idEnd='execution_end'
                    text='$wire.dates.execution_days'
                    title='Ejecución'
                    :designation="$designation && !$isEditing"
                    next="preliminary_start"
                />
                <x-input-date-planning
                    idStart='preliminary_start'
                    idEnd='preliminary_end'
                    text='$wire.dates.preliminary_days'
                    title='Informe Preliminar'
                    :designation="$designation && !$isEditing"
                    next="download_start"
                />
                <x-input-date-planning
                    idStart='download_start'
                    idEnd='download_end'
                    text='$wire.dates.download_days'
                    title='Descargo'
                    :designation="$designation && !$isEditing"
                    next="definitive_start"
                />
            @else
                <x-input-date-planning
                    idStart='execution_start'
                    idEnd='execution_end'
                    text='$wire.dates.execution_days'
                    title='Ejecución'
                    :designation="$designation && !$isEditing"
                    next="definitive_start"
                />
            @endif
            <x-input-date-planning
                idStart='definitive_start'
                idEnd='definitive_end'
                text='$wire.dates.definitive_days'
                title='Informe definitivo'
                :designation="$designation && !$isEditing"
            />
            <x-errors-all :custom="$errors"/>
    </div>

    
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
                    contador = 0
                    while (workingDays > 1) {
                        isWeekend = this.isWeekend(date);
                        if(!this.isHoliday(date) && !isWeekend) { 
                            workingDays--;
                        }
                        if (isWeekend) { 
                            date.add(2, 'days'); 


                        }
                        else {
                            date.add(1, 'days')
                        }                         
                        
                        if(workingDays == 1) {
                            while (this.isHoliday(date) || this.isWeekend(date)) { 
                                date.add(1, 'days'); 
                            } 
                        }
                    }

                    return date.format('DD/MM/YYYY');
                },

                isHoliday(date) {
                    return this.excludeDaysMoment.some(moment => date.isSame(moment)) ? true : false;
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
                    Object.keys(this.flatpickrs).forEach(property => {
                        if (typeof this.flatpickrs[property].destroy === 'function')
                        this.flatpickrs[property].destroy();
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
