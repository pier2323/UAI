@props(['id','title', 'placeholder' => null])

<div class="flex flex-col mb-3">
    <label class="border-0 border-black font-semibold" for="{{ $id }}"> {{ \__("$title:") }} </label>
    <x-input-error for='{{ $id }}'/>
        <input id="{{ $id }}"
            class="border-2 border-black h-11 rounded-xl focus:ring-0 font-semibold text-center max-w-60" 
            wire:model="handoverDocument.{{ $id }}" 
        />
</div>