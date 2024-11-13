<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <form wire:submit="loadData" class="m-5">
        <input class="bg-white" type="file" wire:model="archive" class="flex flex-col" />

{{--    @if($archive)
        <img src="{{$archive->temporaryUrl()}}" alt="">
        @endif --}}

        <x-secondary-button type="submit">Subir Plan Operativo</x-secondary-button>
        <x-button type="button" wire:click="getData">Show data</x-button>
        <x-button type="button" x-on:click="$wire.auditActivityNew.description = 'hola';console.log($wire.auditActivityNew);">Show data</x-button>
    </form>
</div>
