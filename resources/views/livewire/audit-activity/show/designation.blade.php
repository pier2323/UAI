<div role="designation">
    @isset($designation) @push('alert') <x-notification on='designation_download'/> @endpush @endisset
    @empty($designation) @push('alert') <x-notification on='designation_designate'/> @endpush @endempty

    {{-- todo planning form --}}
    <form wire:submit="designate" onkeydown="return event.key != 'Enter';">
        <x-section-basic class="">

            <div class="mb-3">
                <div class="flex justify-between">
                    <div class="flex">
                        <h3 class="text-3xl font-semibold">{{ \__("Designación y Acreditación") }}</h3>
                        <h3 class="mx-2 text-3xl font-semibold"> {{ \__("-") }} </h3>
                        @empty($designation) <h3 class="text-3xl font-semibold">{{ \__("Registro") }}</h3> @endempty
                        @isset($designation) <h3 class="text-3xl font-semibold">{{ \__("Información") }}</h3> @endisset
                    </div>
                    <div>
                        <figure wire:click="edit" class="flex items-center justify-between">
                            <span class="mr-2">{{\__("Edit")}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z"/></svg>
                        </figure>
                    </div>
                </div>
                <hr class="mt-2">
            </div>

            <div class="flex justify-between w-full px-10">
                <livewire:Components.TableCardsEmployee :$auditActivity :$designation>
                
                <div class="ml-4">
                    <livewire:Components.PlanningSchedule :$auditActivity :$designation>
                </div>
            </div>

            <x-slot:footer>
                <div class="flex">

                    <div class="mx-4">
                        @isset($designation) <x-button wire:click='getDesignationDocument'>descargar designación</x-button> @endisset
                        @empty($designation) <x-button type='submit' class="ml-4" wire:click="$dispatch('saving')">Designar</x-button> @endempty
                    </div>
                    
                    <div class="mx-2">
                        @isset($designation) 
                        {{-- todo Acreditation --}}
                        <livewire:AuditActivity.Show.Acreditation :$auditActivity :$acreditation>
                        @endisset
                    </div>

                </div>
            </x-slot>
            
        </x-section-basic>
    </form>
</div>
