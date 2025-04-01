@push('script') @vite(['resources/js/hola.js']) @endpush

<div x-data='handoverDates' x-init="init()" class="p-3 overflow-hidden border rounded-lg border-slate-600">

    <h3 class='mt-1 mb-1.5 ml-2 text-2xl' >Acta de entrega</h3>
    <hr class="mb-3">

    <div>
        
        {{-- todo dates --}}
        <div class="flex flex-col mb-1.5">

            {{-- todo Dates --}}
            <div role="dates" class="flex flex-col items-center">

                {{-- todo Start --}}
                <x-input-handover-date id='start' title="Fecha de Inicio del Periodo" />
    
                {{-- todo Cease --}}
                <x-input-handover-date id='cease' title="Fecha del Cese de Funciones" />
    
                {{-- todo Subscription --}}
                <x-input-handover-date id='subscription' title="Fecha de suscripción" />
                
                {{-- todo Delivery UAI --}}
                <x-input-handover-date id='delivery_uai' title="Fecha de recibo en la UAI" />

            </div>
            <hr class="mb-3">


            {{-- todo Departament --}}
            <div class="mt-2">  
                <x-label for="handoverDocument.departament">{{\__("Unidad que Entrega")}}</x-label>
                <textarea id="handoverDocument.departament" wire:model="handoverDocument.departament" rows="2" 
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500
                @cannot('handoverDocument.register') 
                    bg-slate-200 
                @endcannot
                " placeholder="Escribe aqui el nombre completo de la Unidad que Entrega..." @readonly($hasHandoverDocument or auth()->user()->cannot('handoverDocument.register'))></textarea>
                <x-input-error for="handoverDocument.departament" />
            </div>

            {{-- todo Departament Affiliation --}}
            <div class="mt-2">  
                <x-label for="handoverDocument.departament_affiliation">{{\__("Unidad de adscripcion")}}</x-label>
                <textarea id="handoverDocument.departament_affiliation" rows="2" 
                wire:model="handoverDocument.departament_affiliation" 
                placeholder="Escribe aqui el nombre completo de la Unidad de Adscripcion" 
                x-effect="toggleAttr(isEditing, this.$el)"
                @readonly($hasHandoverDocument or auth()->user()->cannot('handoverDocument.register'))
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 
                @cannot('handoverDocument.register') 
                    bg-slate-200
                @endcannot
                "></textarea>
                <x-input-error for="handoverDocument.departament_affiliation" />
            </div>

        </div>
        
    </div>

    @if(!$hasHandoverDocument)
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
                        locale: {
                            // firstDayOfWeek: 1,
                            weekdays: {
                            shorthand: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                            }, 
                            months: {
                            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                            longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                            },
                        },
                    }

                    @can('handoverDocument.register')
                    for (const property of this.properties) {
                        flatpickr(`#${property}`, config);
                    }
                    @endcan
                },
            }
        })
    </script>
    @endscript
    @endif

</div>
