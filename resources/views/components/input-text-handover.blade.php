@props(['property', 'title', 'placeholder' => null])

<div class="w-full">
    <label class="col-form-label" for="{{ $property }}">{{$title}}:</label>
    <div class="flex">

        @isset($prefix) {{ $prefix }} @endisset
        
        <input 
            id="{{ $property }}" 
            name="{{ $property }}" 
            class="flex h-10 w-full items-center rounded-md border @error($property) border-red-400 @else border-gray-300 @enderror pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
            type="text" 
            x-on:input="$wire.{{ $property }} = updateValue($wire.{{ $property }}, 6)" 
            x-model="$wire.{{ $property }}"
            wire:model.defer="{{ $property }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes['x-on:input'] }}
        >
        
    </div>
</div>