<div x-data>
    {{-- The best athlete wants his opponent at his best. --}}

    <form wire:submit="getData" class="m-5">
        <input class="bg-white" type="file" wire:model="archive" class="flex flex-col" />
        <x-secondary-button type="submit">Subir</x-secondary-button>
    </form>

    <!-- if -->
    @if ($isLoad)

    <x-dialog-modal wire:model="isLoad" maxWidth="5xl" class="overflow-hidden">
        <x-slot name="title">
            <h3 class="text-2xl">Nueva Lista de Actuaciones | POA</h3>
        </x-slot>

        <x-slot name="content">

            <style>
                .tableAuditActivityNew-header-grid-custom {
                    width: 100%;
                    display: grid;
                    grid-template-columns: 1fr 3fr 8fr 2fr;
                    row-gap: 2rem;
                    /* background-color: red; */
                }

                .tableAuditActivityNew-rows-alpine-grid-custom {
                    display: grid;
                    grid-template-columns: 1fr 3fr 8fr 2fr;
                    column-gap: .5rem

                    /* height: 100px; */
                }

                .tableAuditActivityNew-cell-alpine-grid-custom {
                    width: 100%;
                    text-align: center;
                }

                .tableAuditActivityNew-Descripción-description {
                    width: 100%;
                    /* text-align: start; */
                    text-align: justify!important;
                }

            </style>

            <x-table-alpine name="tableAuditActivityNew" :data="$auditActivities" customTable
                :nameColumns="[
                    'Nro' => 'public_id',
                    'Auditado' => 'departament.name',
                    'Descripción' => 'description',
                    'Tipo de auditoria' => 'type_audit.name',
                ]"
                nameColumnId="public_id"
                {{-- eventRow="x-on:dblclick" --}}
            />

        </x-slot>
        <x-slot name="footer">

            <x-button class="mr-4" wire:click="save">Guardar</x-button>
            <x-secondary-button wire:click="cancel">Cancelar</x-secondary-button>

        </x-slot>
    </x-dialog-modal>

    @endif
</div>
