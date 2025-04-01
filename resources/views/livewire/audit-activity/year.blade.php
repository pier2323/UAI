{{-- Stop trying to control. --}}
<div x-data="year" class="m-4">
    <x-secondary-button type="button" x-on:click="openModal()">{{ $year->selected }}</x-secondary-button>

    <x-dialog-modal wire:model="is_open" maxWidth="2xl">
        <x-slot name="title">Configuracion del Año Fiscal</x-slot>
        <x-slot name="content">

            @php
                $years = \App\Models\AuditActivity::distinct()->orderBy('year', 'asc')->pluck('year');
            @endphp

            <div class="flex items-center justify-center py-4 my-2 overflow-scroll flex-nowrap">

                @foreach ($years as $index => $yearValue)
                    <div class="flex items-center">
                        @if ($index !== 0)
                            <div role="line" class="bg-purple-600 h-0.5 w-8"></div>
                        @endif
                        <x-year-radio model="year.forSelection" value="{{ $yearValue }}" />
                    </div>
                @endforeach

            </div>


        </x-slot>
        <x-slot name="footer">
            <x-button type="button" class="mr-3" x-on:click="changeSelected()" x-show="isChangeSelected($wire)">
                Ver
            </x-button>

            @if ($year->selected == $year->active)
                <x-button class="bg-red-400 focus:bg-red-500 hover:bg-red-300 active:bg-red-600"
                    type="button"
                    wire:confirm
                    x-on:click="closeYear()"
                >
                    Cerrar Año fiscal
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
    
</div>

@script
    <script>
        Alpine.data('year', () => {
            return {
                openModal() {
                    $wire.is_open = true;
                },

                changeSelected() {
                    $wire.changeSelected().then(() => {$wire.$parent.refresh()})
                },

                isChangeSelected() {
                    return $wire.year.selected != $wire.year.forSelection;
                },

                isCloseYear() {
                    $wire.closeYear().then(() => {
                        $wire.$parent.refresh();
                    })
                },
            }
        });
    </script>
@endscript
