<div role="designation">
    @isset($designation) @push('alert') <x-notification on='designation_download'/> @endpush @endisset
    @empty($designation) @push('alert') <x-notification on='designation_designate'/> @endpush @endempty

    {{-- todo planning form --}}
    <form wire:submit="designate" onkeydown="return event.key != 'Enter';">
        <x-section-basic class="flex">

            <livewire:Components.TableCardsEmployee :$auditActivity :$designation>
            
            <x-slot:article>
                <div class="ml-4">
                    <livewire:Components.PlanningSchedule :$auditActivity :$designation>
                </div>
            </x-slot>

            <x-slot:footer>
                <div class="flex">

                    <div class="mx-4">
                        @isset($designation) <x-button wire:click='getDesignationDocument'>descargar designacion</x-button> @endisset
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
