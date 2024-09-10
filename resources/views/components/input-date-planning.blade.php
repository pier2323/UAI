@props(['idStart', 'idEnd', 'text', 'title', 'class' => 'mt-3'])
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
                x-on:input="{{ $text }} = calculateDays($wire.{{ $idStart }}, $wire.{{ $idEnd }})"  
                placeholder="Fin.." 
                x-model="$wire.{{ $idEnd }}" 
                wire:model='{{ $idEnd }}' 
                readonly
            />
        </div>
        <div>
            <span class="flex items-center justify-center p-2 ml-2 bg-blue-100 rounded-lg h-11 min-w-28" x-text="'Habiles: ' + {{ $text }}"></span>
        </div>
    </div>
</div>