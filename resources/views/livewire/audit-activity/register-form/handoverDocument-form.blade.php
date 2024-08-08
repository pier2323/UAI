<script src="js/auditActivity/registerFormScript/handoverDocument.js" defer></script>

<div x-data='handoverDocument()' >
    <x-button type='button' class='w-24 flex justify-center' x-on:click="isOpened = !isOpened">Acta</x-button>

    {{-- <x-notification-error on='query_error_incoming'>{{$handoverDocument->errorMessage}}</x-notification-error>
    <x-secondary-button 
        class="ml-4" 
        type='button' 
        x-on:click="$wire.incoming.query = prompt('Ingresa el p00 del personal saliente para buscar')" 
        wire:click="queryIncoming"
    >
        Consultar Entrante
    </x-secondary-button> --}}

    <div class="section p-2 overflow-hidden" x-bind:class="isOpened ? 'active' : ''"> 

        {{-- todo Name --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="handoverDocument.name">Nombre del Acta de Entrega:</label>
            <x-input-error for='handoverDocument.name'/>
            <div class="flex">
                <input 
                    id="handoverDocument.name" 
                    class="{{ $input }}"
                    name="handoverDocument.name" 
                    type="text" 
                    wire:model="handoverDocument.name"
                >
            </div>
        </div>

        {{-- todo Target --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="handoverDocument.target">Objetivo del Acta de Entrega:</label>
            <x-input-error for='handoverDocument.target'/>
            <div class="flex">
                <input 
                    id="handoverDocument.target" 
                    class="{{ $input }}"
                    name="handoverDocument.target" 
                    type="text" 
                    wire:model="handoverDocument.target"
                >
            </div>
        </div>


        {{-- todo Cease --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="handoverDocument.cease">Fecha del Cese de Funciones:</label>
            <x-input-error for='handoverDocument.cease'/>
            <div class="flex">

                <input 
                    id="handoverDocument.cease" 
                    class="{{ $input }}"
                    name="handoverDocument.cease"
                    type="date"
                    wire:model="handoverDocument.cease"
                >
            </div>
        </div>

        {{-- todo Subscription --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="handoverDocument.subscription">Fecha de suscripción del Acta de Entrega:</label>
            <x-input-error for='handoverDocument.subscription'/>
            <div class="flex">

                <input 
                    id="handoverDocument.subscription" 
                    class="{{ $input }}"
                    name="handoverDocument.subscription"
                    type="date"
                    wire:model="handoverDocument.subscription"
                >
            </div>
        </div>

        {{-- todo Delivery UAI --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="handoverDocument.delivery_uai">Fecha de recibo en la UAI:</label>
            <x-input-error for='handoverDocument.delivery_uai'/>
            <div class="flex">

                <input 
                    id="handoverDocument.delivery_uai" 
                    class="{{ $input }}"
                    name="handoverDocument.delivery_uai"
                    type="date"
                    wire:model="handoverDocument.delivery_uai"
                >
            </div>
        </div>

        {{-- todo Buttons  --}}
        <div class="w-full mt-2 flex justify-center">
            <x-button type='button' class="bg-red-400 mr-1" wire:click="restartHandoverDocument">Limpiar</x-button>
            <x-button type='button' class="bg-green-600 ml-1" wire:click="verifyHandoverDocument">Verificar</x-button>
        </div>

        {{-- todo All Errors  --}}
        @if ($handoverDocument->verified == 1)            
            <div class="bg-teal-100 border-t-4 mt-3 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <strong class="font-bold">Todo OK!</strong>
                <br>
                <span class="block sm:inline">Todos los campos del <strong>Acta de Entrega</strong> han sido escritos correctamente.</span>
            </div>
        @elseif ($handoverDocument->verified == 2)
            <div class="bg-red-100 border mt-3 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
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
