@props(['id','title', 'placeholder' => null, 'readonly' => null])

<div class="flex flex-col mb-3">
    <label class="font-semibold border-0 border-black" for="{{ $id }}"> {{ \__("$title:") }} </label>

    <input @empty($modelsHandoverDocument) id="{{ $id }}" @endempty
        type="text"
        class="font-semibold text-center border-2 border-black h-11 rounded-xl focus:ring-0 max-w-60" 
        wire:model="handoverDocument.{{ $id }}" 
        readonly
    />
    <x-input-error for='handoverDocument.{{ $id }}'/>  

</div>