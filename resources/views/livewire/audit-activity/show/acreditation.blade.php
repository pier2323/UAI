<div role="acreditation">
    @isset($designation) @push('alert') <x-notification on='acreditation_download'/> @endpush @endisset
    @empty($designation) @push('alert') <x-notification on='acreditation_acredit'/> @endpush @endempty

    
    {{-- todo Modal Acreditation --}}
    @empty($acreditation)
    
    @assets @vite(['resources/js/hola.js']) @endassets
    
    <form 
        x-data 
        wire:submit='acredit' 
        x-init="
        flatpickr('#acreditationDateRelease', {
            dateFormat: 'd/m/Y',
            disable: [(date) => (date.getDay() === 0 || date.getDay() === 6)]
        });"
    >
        
        {{-- todo modal --}}
        <x-dialog-modal wire:model="openModalAcreditation">
            <x-slot:title>{{ \__("Fecha de la Acreditacion") }}</x-slot>
            <x-slot:content>
                <div>
                    <label class="mr-2 text-xl font-semibold" for="acreditationDateRelease"> {{ \__('Fecha:') }} </label>
                    <x-input class="w-56 text-2xl font-bold " type="text" id="acreditationDateRelease" wire:model="accreditDateRelease" readonly/>
                </div>
            </x-slot>
            <x-slot:footer>
                <x-button class="mr-4" type='submit'>{{ \__('Guardar') }}</x-button>
                <x-secondary-button x-on:click="$wire.openModalAcreditation = false; $wire.accreditDateRelease = null ">{{ \__('Cancelar') }}</x-secondary-button>
            </x-slot>
        </x-dialog-modal>

    </form>
    
    @endempty
    
    {{-- todo Download Acreditation --}}
    @isset($acreditation) <x-secondary-button wire:click='getAcreditationDocument'>descargar acreditacion</x-secondary-button> @endisset
    
    {{-- todo Acredit --}}
    @empty($acreditation) <x-secondary-button type='submit' class="ml-4" x-on:click="$wire.openModalAcreditation = true"> {{ \__('Acreditar') }} </x-secondary-button> @endempty

</div>
