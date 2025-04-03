@props([
    'property', 
    'title', 
    'placeholder' => null, 
    'custom' => false, 
    'input' => 'transformedInput', 
    'limit' => 6,
    'select' => false, 
    'readonly' => null
])

<div class="w-full">
    <label class="col-form-label" for="{{ $property }}">{{$title ?? dd($property)}}:</label>
    <div class="flex">
        @if (!$select)
        @isset($prefix) {{ $prefix }} @endisset
        
        <input 
            id="{{ $property }}" 
            name="{{ $property }}" 
            class="flex h-10 w-full items-center rounded-md border @error($property) border-red-400 @else border-gray-300 @enderror pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
            type="text" 
            @if ($custom) {{$attributes['x-on:input']}}
            @else x-on:input="$wire.{{ $property }} = {{$input}}($wire.{{ $property }}, {{ $limit }})" @endif
            x-model="$wire.{{ $property }}"
            wire:model="{{ $property }}"
            {{ $attributes['x-on:input'] }}
            @readonly($readonly or auth()->user()->cannot('handoverDocument.register'))
        >

        @else
            <select 
                class="flex h-10 w-full items-center rounded-md border @error($property) border-red-400 @else border-gray-300 @enderror pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                id="{{ $property }}" 
                placeholder="{{ $placeholder }}"
                wire:model="{{ $property }}"
                name="{{ $property }}"
                @if ($custom) {{$attributes['x-on:input']}} @endif
            >
                {{$options}}
            </select>
        @endif
        
    </div>
</div>