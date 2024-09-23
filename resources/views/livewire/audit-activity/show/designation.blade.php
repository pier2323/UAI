<div role="designation">
    @push('alert') <x-notification on='designation'/> @endpush

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
                @isset($designation) <x-button wire:click='getDesignationDocument'>descargar designacion</x-button> @endisset
                @empty($designation) <x-button type='submit' class="ml-4" wire:click="$dispatch('saving')">Designar</x-button> @endempty
            </x-slot>
            
        </x-section-basic>
    </form>
</div>
