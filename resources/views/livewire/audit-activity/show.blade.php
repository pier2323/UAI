<div>
    {{-- <x-notification on='saved' message='{{session('status')}}' active/> --}}
    @isset($designation) <x-button wire:click='getDesignationDocument'>descargar designacion</x-button> @endisset
    @isset($acreditation) <x-button wire:click='getAcreditationDocument'>descargar acreditacion</x-button> @endisset
    @if(isset($designation) && !isset($acreditation)) <x-button class="ml-4" wire:click='accredit'>Acreditar</x-button> @endif


    {{-- todo headings --}}
    <div role="headings">   <livewire:Components.AuditActivityHeadings :$auditActivity objective></div>

    <form wire:submit='designate'>
    <x-section-basic class="flex">
        {{-- todo planning form --}}

                <livewire:Components.TableCardsEmployee :$auditActivity :$designation :$acreditation>
                    
                <x-slot:article>
                    <div class="ml-4">
                        <livewire:Components.PlanningSchedule :$auditActivity :$designation :$acreditation>
                    </div>
                </x-slot>

                @empty($designation)

                    <x-slot:footer>
                        <x-button class="ml-4" x-on:click="$dispatch('prepare')" wire:submit>Designar</x-button>
                    </x-slot>
                    
                @endempty
                
            </x-section-basic>
        </form>
        
</div>
