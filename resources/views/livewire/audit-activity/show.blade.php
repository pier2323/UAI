<div>
    {{-- <x-notification on='saved' message='{{session('status')}}' active/> --}}
    <x-button wire:click='getDesignationDocument'>descargar designacion</x-button>


    {{-- todo headings --}}
    <div role="headings">   <livewire:Components.AuditActivityHeadings audit='{{ $auditActivity->id }}' objective></div>

    <form wire:submit='save'>
    <x-section-basic class="flex">
        {{-- todo planning form --}}

                <livewire:Components.TableCardsEmployee auditActivity='{{ $auditActivity->id }}'>
                    
                <x-slot:article>
                    <div class="ml-4">
                        <livewire:Components.PlanningSchedule auditActivity="{{ $auditActivity->id }}">
                    </div>
                </x-slot>

                <x-slot:footer>
                    <x-button class="ml-4" x-on:click="$dispatch('prepare')" wire:submit>Guardar</x-button>
                </x-slot>
        </x-section-basic>
    </form>
        
</div>
