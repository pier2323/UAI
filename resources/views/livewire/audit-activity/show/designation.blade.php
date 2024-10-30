<div role="designation">
    @if($isCreated)
    @push('alert')
    <x-notification on='designation_designate'/>
    <x-notification on='designation_download'/>
    @endpush
    @endif
    @if($isCreated) @push('alert') <x-notification on='designation_updated'/> @endpush @endif

    {{-- todo planning form --}}
    <form wire:submit="{{!$isEditing ? 'designate' : 'update'}}" onkeydown="return event.key != 'Enter';">
        <x-section-basic class="">

            {{-- todo header --}}
            <div class="mb-3">
                <div class="flex justify-between">

                    {{-- todo title --}}
                    <div class="flex">
                        <h3 class="text-3xl font-semibold">

                        {{ \__("Designación y Acreditación") }} -
                        @if(!$isCreated) {{ \__("Registro") }} @endif
                        @if($isCreated && $isEditing) {{ \__("Editando") }} @endif
                        @if($isCreated && !$isEditing) {{ \__("Información") }} @endif

                        </h3>
                    </div>

                    {{-- todo buttons --}}
                    <div class="flex items-center @if($isEditing) bg-yellow-100 rounded-xl pl-2 @endif">

                        @if($isCreated && !$isEditing)
                        <figure type="button" x-on:click="$wire.isDeleting = true" class="flex items-center justify-between p-2 mr-2 bg-red-100 rounded-full m hover:bg-red-200 active:bg-red-300">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                        </figure>


                        <x-dialog-modal wire:model="isDeleting" id='deleteModal' maxWidth='sm'>
                            <x-slot name="title"><h5 class="flex justify-center w-full">¿Está seguro que desea eliminar la Designación?</h5></x-slot>
                            <x-slot name="footer">
                                <x-button type="button" class="mr-2" wire:click="delete">Si</x-button>
                                <x-secondary-button type="button" x-on:click="$wire.isDeleting = false">No</x-secondary-button>
                            </x-slot>
                        </x-dialog-modal>


                        <figure type="button" wire:click="edit" class="flex items-center justify-between p-2 bg-yellow-100 rounded-full hover:bg-yellow-200 active:bg-yellow-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z"/></svg>
                        </figure>
                        @elseif ($isEditing)
                        <span class="mr-3 text-xl font-semibold">Editando</span>
                        <figure type="button" x-on:click="$dispatch('cancel'); $wire.cancelEdit()" class="flex items-center justify-between p-2 rounded-xl hover:bg-red-200 active:bg-blue-200">
                            {{-- <span class="mr-2">{{\__("Edit")}}</span> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                        </figure>
                        @endif

                    </div>


                </div>
                <hr class="mt-2">
            </div>

            <div class="flex justify-between w-full px-10">

                <livewire:Components.TableCardsEmployee :$auditActivity :$isEditing :$isCreated
                wire:model.live="tableEmployees.list">

                <div class="ml-4">
                    {{-- <livewire:Components.PlanningSchedule :$auditActivity :$designation :$isEditing :$isCreated> --}}
                    </div>
                </div>

            <x-slot:footer>
                <div class="flex">

                    <div class="mx-4">
                        @if($isCreated)

                            @if($isEditing)
                                <x-button type="submit" x-on:click="$dispatch('saving')">
                                    Guardar cambios
                                </x-button>

                            @else
                                <x-button type="button" wire:click='getDesignationDocument'>
                                    Descargar designación
                                </x-button>
                            @endif


                        @else
                            <x-button
                                type='submit'
                                class="ml-4"
                                x-on:click="$dispatch('saving'); $wire.isCreated = true"
                            >
                                Designar
                            </x-button>

                        @endif
                    </div>

                    <div class="mx-2">
                        @if($isEditing)
                        {{-- todo Acreditation --}}
                        <livewire:AuditActivity.Show.Acreditation :$auditActivity :$acreditation>
                        @endif
                    </div>

                </div>
            </x-slot>

        </x-section-basic>
    </form>
</div>
