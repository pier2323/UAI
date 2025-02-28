@push('alert') 
    <x-alert on='acreditation_acredit'/> 
    <x-alert on='acreditation_download'/> 
@endpush 

<div role="acreditation" x-data="acreditation">

    {{-- todo Modal Acreditation --}}
    @if(empty($acreditation) and auth()->user()->can('auditActivity.show.designationAcreditation'))

        {{-- todo modal --}}
        <x-dialog-modal wire:model="openModalAcreditation">
            <x-slot:title>Fecha de la Acreditacion</x-slot>
            <x-slot:content>
                <div>
                    <label class="mr-2 text-xl font-semibold" for="acreditationDateRelease"> Fecha: </label>
                    <x-input class="w-56 text-2xl font-bold " type="text" id="acreditationDateRelease" wire:model="accreditDateRelease" readonly/>
                </div>
            </x-slot>
            <x-slot:footer>
                <x-button class="mr-4" type="button" wire:click="acredit">{{ \__('Guardar') }}</x-button>
                <x-secondary-button type="button" x-on:click="cancel()">Cancelar</x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    
    @endif
    
    {{-- todo Download Acreditation --}}
    @isset($acreditation) 
        <x-secondary-button type="button" wire:click='getAcreditationDocument'
        >
            descargar acreditacion
        </x-secondary-button> 
    @endisset
    
    @can('auditActivity.show.designationAcreditation')
        {{-- todo Acredit --}}
        @empty($acreditation) 
            <x-secondary-button type='button' class="ml-4" x-on:click="openModal()"> Acreditar </x-secondary-button> 
        @endempty
    @endcan

</div>

@script
    <script>
        Alpine.data('acreditation', () => {
            return {
                configFlatpickr: {
                    dateFormat: 'd/m/Y',
                    disable: [(date) => (date.getDay() === 0 || date.getDay() === 6)],
                    locale: {
                        // firstDayOfWeek: 1,
                        weekdays: {
                        shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        },
                        months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                        longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        },
                    },
                },

                cancel() {
                    $wire.openModalAcreditation = false;
                    $wire.accreditDateRelease = null ;
                },

                openModel() {
                    $wire.openModalAcreditation = true
                },
                
                init() {
                    flatpickr('#acreditationDateRelease', this.configFlatpickr);
                },
            }
        })
    </script>
@endscript
