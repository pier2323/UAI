@push('script') @vite(['resources/js/hola.js']) @endpush

@script
<script>
    Alpine.data('handoverDates', () => {
        return {
            formatDate: "d/m/Y", 
            init() {
            // {{-- todo planning --}}
                flatpickr("#cease", {
                    maxDate: "today",
                    dateFormat: this.formatDate,
                });
    
                // {{-- todo planning --}}
                flatpickr("#subscription", {
                    maxDate: "today",
                    dateFormat: this.formatDate,
                });
    
                // {{-- todo planning --}}
                flatpickr("#delivery_uai", {
                    maxDate: "today",
                    dateFormat: this.formatDate,
                });

                console.log('hola');
                
            },
        }
    })
</script>
@endscript

<div x-data='handoverDates' x-init="init()" class="w-full">
    
    <span>
        <h3 class='mt-4 mb-3 ml-10 text-2xl' >Acta de entrega</h3>
    </span>
    <div>

        {{-- todo Code --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="handoverDocument.code"><strong>Codigo</strong> de la Actuacion Fiscal:</label>
            <x-input-error for='handoverDocument.code'/>
            <div class="flex">
                <input 
                    id="handoverDocument.code" 
                    class="{{ $input }}"
                    name="handoverDocument.code" 
                    type="text" 
                    wire:model="handoverDocument.code"
                    placeholder="UAI/GCP/ACR-COM 2024-001"
                >
            </div>
        </div>

        {{-- todo Name --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="handoverDocument.name"><strong>Descripcion</strong> de la Actuacion Fiscal:</label>
            <x-input-error for='handoverDocument.name'/>
            <div class="flex">
                <input 
                    id="handoverDocument.name" 
                    class="{{ $input }}"
                    name="handoverDocument.name" 
                    type="text" 
                    wire:model="handoverDocument.name"
                    placeholder="Verificación acta de entrega de la Gerencia de Contrataciones Públicas"
                >
            </div>
        </div>

        {{-- todo Target --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="handoverDocument.target"><strong>Objetivo</strong> del Actuacion Fiscal:</label>
            <x-input-error for='handoverDocument.target'/>
            <div class="flex">
                <textarea rows="5"
                    id="handoverDocument.target" 
                    class="items-center w-full pl-3 text-sm font-normal text-gray-600 border border-gray-300 border-red-400 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none"
                    name="handoverDocument.target" 
                    type="text" 
                    wire:model="handoverDocument.target"
                    placeholder='Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Contrataciones Públicas adscrita a la Gerencia General de Consultoría Jurídica de la Cantv, correspondiente al servidor público saliente ciudadano Ronal Uzcategui Arias, titular de la cédula de identidad V-16.604.173, suscrita en fecha 01/08/2023".'
                ></textarea>
            </div>
        </div>

        
        {{-- todo dates --}}
        <div class="flex gap-6">

            {{-- todo Cease --}}
            <div class="w-full">
                <label class="{{ $label }}" for="cease"><strong>Fecha del Cese de Funciones:</strong></label>
                <x-input-error for='handoverDocument.cease'/>
                <div class="flex">

                    <x-input 
                        id="cease" 
                        class="{{ $input }}"
                        name="handoverDocument.cease"
                        wire:model="handoverDocument.cease"
                        readonly
                    />
                </div>
            </div>

            {{-- todo Subscription --}}
            <div class="w-full">
                <label class="{{ $label }}" for="subscription"><strong>Fecha de suscripción:</strong></label>
                <x-input-error for='handoverDocument.subscription'/>
                <div class="flex">

                    <input 
                        id="subscription" 
                        class="{{ $input }}"
                        name="handoverDocument.subscription"
                        wire:model="handoverDocument.subscription"
                        readonly
                    >
                </div>
            </div>

            {{-- todo Delivery UAI --}}
            <div class="w-full">
                <label class="{{ $label }}" for="delivery_uai"><strong>Fecha de recibo en la UAI:</strong></label>
                <x-input-error for='handoverDocument.delivery_uai'/>
                <div class="flex">

                    <input 
                        id="delivery_uai" 
                        class="{{ $input }}"
                        name="handoverDocument.delivery_uai"
                        wire:model="handoverDocument.delivery_uai"
                        readonly
                    >
                </div>
            </div>

        </div>

        {{-- todo Buttons  --}}
        <div class="flex justify-center w-full mt-4">
            <x-button type='button' class="mr-1 bg-red-400" wire:click="restartHandoverDocument">Limpiar</x-button>
            <x-button type='button' class="ml-1 bg-green-600" wire:click="verifyHandoverDocument">Verificar</x-button>
        </div>

        {{-- todo All Errors  --}}
        @if ($handoverDocument->verified == 1)            
            <div class="px-4 py-3 mt-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md" role="alert">
                <strong class="font-bold">Todo OK!</strong>
                <br>
                <span class="block sm:inline">Todos los campos del <strong>Acta de Entrega</strong> han sido escritos correctamente.</span>
            </div>
        @elseif ($handoverDocument->verified == 2)
            <div class="relative px-4 py-3 mt-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <strong class="font-bold">Error!</strong>
                <br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            <span class="block sm:inline">{{$error}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <hr class="mt-3 mb-3">
    </div>
</div>
