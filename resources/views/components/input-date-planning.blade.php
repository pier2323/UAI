@props(['idStart', 'idEnd', 'text', 'title', 'class' => 'mt-3', 'designation' => false, 'next' => null])

<div class="{{ $class }}">
    <span>{{ $title }}:</span>
    <div class="flex items-center justify-between w-fit">
        <div class="flex flex-row">
            <input type="text"
                class="border-r-0 border-black h-11 w-28 rounded-s-xl focus:ring-0"
                id="{{ $idStart }}"
                placeholder="Inicio.."
                @can('auditActivity.show.designationAcreditation')
                x-on:input="{{ $text }} = calculateDays($wire.dates.{{ $idStart }}, $wire.dates.{{ $idEnd }})"
                @endcan
                x-model="$wire.dates.{{ $idStart }}"
                wire:model='dates.{{ $idStart }}'
                readonly
            />
            <div class="flex items-center justify-center bg-white border-black border-y">
                <div class="w-4 h-0.5 bg-black"></div>
            </div>

            <input type="text"
                class="border-l-0 border-black h-11 w-28 rounded-e-xl focus:ring-0"
                id="{{ $idEnd }}"
                @can('auditActivity.show.designationAcreditation')
                    x-on:input="{{ $text }} = calculateDays($wire.dates.{{ $idStart }}, $wire.dates.{{ $idEnd }});
                    @isset($dates->{$next})
                    
                    $wire.dates.{{$next}} = calculateDates($wire.dates.{{$idEnd}}, 2)
                    
                    let momentNext = moment($wire.dates.{{$next}}, 'DD/MM/YYYY').format('YYYY-MM-DD');
                    let date = new Date(`${momentNext}`)
                    date.setDate(date.getDate() + 1)
                    flatpickrs.{{$next}}.setDate(date)
                    
                    @endisset"
                @endcan
                placeholder="Fin.."
                x-model="$wire.dates.{{ $idEnd }}"
                wire:model='dates.{{ $idEnd }}'
                readonly
            />
        </div>
        <div>
            <input
                class="p-1 ml-2 overflow-visible text-center bg-blue-100 rounded-lg number-input-date-planning h-11 w-fit max-w-12 w-min-16"
                type="text"
                @can('auditActivity.show.designationAcreditation')
                    x-on:input="$wire.dates.{{ $idEnd }} = calculateDates($wire.dates.{{ $idStart }}, {{ $text }})
                    @isset($next)
                    $wire.dates.{{$next}} = calculateDates($wire.dates.{{$idEnd}}, 2)
                    
                    let momentNext = moment($wire.dates.{{$next}}, 'DD/MM/YYYY').format('YYYY-MM-DD');
                    let date = new Date(`${momentNext}`)
                    date.setDate(date.getDate() + 1)
                    flatpickrs.{{$next}}.setDate(date)    
                    @endisset"
                @endcan
                
                x-model="{{ $text }}"
                placeholder="{{ \__('dias') }}"
                @readonly($designation or auth()->user()->cannot('auditActivity.show.designationAcreditation'))
            >
        </div>
    </div>
</div>
