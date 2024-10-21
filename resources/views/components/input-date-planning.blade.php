@props(['idStart', 'idEnd', 'text', 'title', 'class' => 'mt-3', 'designation' => false, 'next' => null])

<div class="{{ $class }}">
    <span>{{ $title }}:</span>
    <div class="flex items-center justify-between w-fit">
        <div class="flex flex-row">
            <input
                class="border-r-0 border-black h-11 w-28 rounded-s-xl focus:ring-0 "
                id="{{ $idStart }}"
                placeholder="Inicio.."
                x-on:input="{{ $text }} = calculateDays($wire.{{ $idStart }}, $wire.{{ $idEnd }})"
                x-model="$wire.{{ $idStart }}"
                wire:model='{{ $idStart }}'
                readonly
                />
                <div class="flex items-center justify-center bg-white border-black border-y"><div class="w-4 h-0.5 bg-black"></div></div>
                <input
                class="border-l-0 border-black h-11 w-28 rounded-e-xl focus:ring-0"
                id="{{ $idEnd }}"
                x-on:input="{{ $text }} = calculateDays($wire.{{ $idStart }}, $wire.{{ $idEnd }});
                @isset($next)

                $wire.{{$next}} = calculateDates($wire.{{$idEnd}}, 2)

                let momentNext = moment($wire.{{$next}}, 'DD/MM/YYYY').format('YYYY-MM-DD');
                let date = new Date(`${momentNext}`)
                date.setDate(date.getDate() + 1)
                flatpickrs.{{$next}}.setDate(date)

                @endisset"
                placeholder="Fin.."
                x-model="$wire.{{ $idEnd }}"
                wire:model='{{ $idEnd }}'
                readonly
            />
        </div>
        <div>
            <input
                class="p-1 ml-2 overflow-visible text-center bg-blue-100 rounded-lg number-input-date-planning h-11 w-fit max-w-12 w-min-16"
                type="text"
                x-on:input="$wire.{{ $idEnd }} = calculateDates($wire.{{ $idStart }}, {{ $text }})
                @isset($next)
                $wire.{{$next}} = calculateDates($wire.{{$idEnd}}, 2)

                let momentNext = moment($wire.{{$next}}, 'DD/MM/YYYY').format('YYYY-MM-DD');
                let date = new Date(`${momentNext}`)
                date.setDate(date.getDate() + 1)
                flatpickrs.{{$next}}.setDate(date)

                @endisset
                "
                x-model="{{ $text }}"
                placeholder="{{ \__('dias') }}"
                @readonly($designation)
            >
        </div>
    </div>
</div>
