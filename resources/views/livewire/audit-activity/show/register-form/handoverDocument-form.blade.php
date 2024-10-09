@push('script') @vite(['resources/js/hola.js']) @endpush

<div x-data='handoverDates' x-init="init()" class="p-3 overflow-hidden border border-black rounded-lg max-w-max">

    <h3 class='mt-4 mb-3 ml-10 text-2xl' >Acta de entrega</h3>

    <div>
        
        {{-- todo dates --}}
        <div class="flex flex-col">

            {{-- todo Start --}}
            <x-input-handover-date id='start' title="Fecha de Inicio del Periodo" />

            {{-- todo Cease --}}
            <x-input-handover-date id='cease' title="Fecha del Cese de Funciones" />

            {{-- todo Subscription --}}
            <x-input-handover-date id='subscription' title="Fecha de suscripción" />
            
            {{-- todo Delivery UAI --}}
            <x-input-handover-date id='delivery_uai' title="Fecha de recibo en la UAI" />

        </div>
        
    </div>

    @empty($modelsHandoverDocument)
    @script
    <script>
        Alpine.data('handoverDates', () => {
            return {
                cease: '',
                properties : [
                    'start', 
                    'cease', 
                    'subscription', 
                    'delivery_uai'
                ],

                init() {
                    // alert('hola')
                    const config = {
                        maxDate: "today",
                        dateFormat: "d/m/Y",
                    }

                    for (const property of this.properties) {
                        flatpickr(`#${property}`, config);
                    }
                },
            }
        })
    </script>
    @endscript
    @endempty
</div>
