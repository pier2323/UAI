@push('script')    
@script
<script>

Alpine.data('incoming', () => {
    return {
        isOpened: false,
        markedSecondName: false,
        markedSecondSurname: false,
  
        // * functions
        transformedInput: (input) => input.replace(/\s/g, "").toUpperCase(),

        toggleMark: (marked) => {
            return {
                marked: !marked,
                valueInput: "",
            };
        },
        
        updateValue: (value, limit) => {
            // * Limitar a 8 dígitos
            if (value.length > limit) return value.slice(0, limit);
            return value.replace(/[^0-9]/g, '');
        },
    };
})

</script>
@endscript
@endpush

<div x-data='incoming' class="w-full">
    <h1 class="mt-4 mb-3 ml-10 text-2xl">Entrante</h1>
    
    <div class="w-full"> 
        {{-- <x-notification-error on='query_error_incoming'>{{$incoming->errorMessage}}</x-notification-error>
        <x-secondary-button 
            class="ml-4" 
            type='button' 
            x-on:click="$wire.incoming.query = prompt('Ingresa el p00 del personal saliente para buscar')" 
            wire:click="queryIncoming"
        >
            Consultar Entrante
        </x-secondary-button> --}}

        {{-- todo p00 & personalid --}}
        <div class="flex gap-4 mb-4">

            {{-- todo P00 --}}
            <div class="w-full">
                <label class="{{ $label }}" for="incoming.p00">P00:</label>
                <x-input-error for='incoming.p00'/>
                <div class="flex">
                    <div class="flex items-center h-10 p-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" >P00</div>
                    
                    <p class="block p-2 font-extrabold">-</p>
                    <input 
                        id="incoming.p00" 
                        class="{{ $input }}"
                        name="incoming.p00" 
                        type="text" 
                        x-model="$wire.incoming.p00" 
                        x-on:input="$wire.incoming.p00 = updateValue($wire.incoming.p00, 6)" 
                        wire:model="incoming.p00"
                    >
                </div>
            </div>

            {{-- todo Cedula --}}
            <div class="w-full">
                <label class="{{ $label }}" for="incoming.personal_id">Numero de Cedula:</label>
                <x-input-error for='incoming.personal_id'/>
                <div class="flex">
                    <div class="flex items-center h-10 p-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" >V</div>
                    
                    <p class="block p-2 font-extrabold">-</p>
                    <input 
                        id="incoming.personal_id" 
                        class="{{ $input }}"
                        name="incoming.personal_id" 
                        type="text" 
                        x-model="$wire.incoming.personal_id" 
                        x-on:input="$wire.incoming.personal_id = updateValue($wire.incoming.personal_id, 6)" 
                        wire:model="incoming.personal_id"
                    >
                </div>
            </div>

        </div>
        <hr class="mb-4">
        
        
        {{-- todo fullname --}}
        <div class="mb-4">

            {{-- todo names --}}
            <div class="flex justify-between gap-4">

                {{-- todo firstname --}}
                <div class="w-full">
                    <label class="{{ $label }}" for="incoming.first_name">Primer Nombre:</label>
                    <x-input-error for='incoming.first_name'/>
                    <input 
                        id="incoming.first_name" 
                        class="{{ $input }}" 
                        name="incoming.first_name" 
                        type="text"
                        placeholder="JENBLUK" 
                        x-model="$wire.incoming.first_name"
                        x-on:input="$wire.incoming.first_name = transformedInput($wire.incoming.first_name)" 
                        wire:model="incoming.first_name"
                    />
                </div>

                {{-- todo second_name --}}
                <div class="w-full">
                    <label class="{{ $label }}" for="incoming.second_name">Segundo Nombre:</label>
                    <x-input-error for='incoming.second_name'/>
                    <input 
                        id="incoming.second_name"
                        class="{{ $input }}" 
                        name="incoming.second_name" 
                        type="text" 
                        x-model="$wire.incoming.second_name"
                        x-on:input="$wire.incoming.second_name = transformedInput($wire.incoming.second_name)" 
                        x-bind:class="markedSecondName ? 'bg-gray-200' : ''"
                        x-bind:disabled="markedSecondName" 
                        x-bind:required="markedSecondName" 
                        wire:model="incoming.second_name" 
                    />
                    <div>
                        <label for="second_name-checkbox">No aplica</label>
                        <input 
                            id="second_name-checkbox" 
                            type="checkbox"
                            x-on:change="{ marked: markedSecondName, inputValue: $wire.incoming.second_name } = toggleMark(markedSecondName)" 
                        />
                    </div>
                </div>

            </div>
            
            {{-- todo surnames --}}
            <div class="flex justify-between gap-4">

                {{-- todo FirstSurname --}}
                <div class="w-full">
                    <label class="{{ $label }}" for="incoming.first_surname">Primer Apellido:</label>
                    <x-input-error for='incoming.first_surname'/>
                    <input 
                        id="incoming.first_surname"
                        class="{{ $input }}" 
                        placeholder="VANEGAS" 
                        type="text" 
                        x-model="$wire.incoming.first_surname"
                        x-on:input="$wire.incoming.first_surname = transformedInput($wire.incoming.first_surname)" 
                        wire:model="incoming.first_surname" 
                    />
                </div>

                {{-- todo secondSurname --}}
                <div class="w-full">
                    <label class="{{ $label }}" for="incoming.second_surname">Segundo Apellido:</label>
                    <x-input-error for='incoming.second_surname'/>
                    <input 
                        id="incoming.second_surname"
                        class="{{ $input }}" 
                        name="second_surname" 
                        placeholder="GARCÍA" 
                        type="text"
                        x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''" 
                        x-bind:disabled="markedSecondSurname"
                        x-bind:required="markedSecondSurname" 
                        x-model="$wire.incoming.second_surname"
                        x-on:input="$wire.incoming.second_surname = transformedInput($wire.incoming.second_surname)" 
                        wire:model="incoming.second_surname" 
                    />
                    <div>
                        <label for="second_surname-checkbox">No aplica</label>
                        <input 
                            id="second_surname-checkbox" 
                            type="checkbox"
                            x-on:change="{ marked: markedSecondSurname, inputValue: $wire.incoming.second_surname } = toggleMark(markedSecondSurname)"
                        />
                    </div>
                </div>

            </div>

        </div>
        <hr class="mb-4">
        
        
        {{-- todo emails --}}
        <div class="flex gap-4">

            {{-- todo Gmail --}}
            <div class="w-full">
                <label class="{{ $label }}" for="incoming.gmail">Correo UAI gmail:</label>
                <x-input-error for='incoming.gmail'/>
                <input 
                    id="incoming.gmail" 
                    class="{{ $input }}" 
                    name="incoming.gmail"
                    type="email"
                    placeholder="jenblukvanegas@gmail.com" 
                    x-model='$wire.incoming.gmail'
                    wire:model="incoming.gmail" 
                >
            </div>
            
            {{-- todo Email cantv --}}
            <div class="w-full">
                <label class="{{ $label }}" for="incoming.email_cantv">Correo Institucional:</label>
                <x-input-error for='incoming.email_cantv'/>
                <input 
                    id="incoming.email_cantv" 
                    class="{{ $input }}" 
                    name="incoming.email_cantv"
                    type="email"
                    placeholder="jvane01@cantv.com.ve" 
                    x-model='$wire.incoming.email_cantv'
                    wire:model="incoming.email_cantv"
                >
            </div>

        </div>
        
        {{-- todo phone & JobTitle --}}
        <div class="flex gap-4 mb-4">

            {{-- todo Phone --}}
            <div class="w-full">
                <label class="{{ $label }}" for="incoming.phone_number">Teléfono:</label>
                <x-input-error for='incoming.phone_code'/>
                <x-input-error for='incoming.phone_number'/>
                <div class="flex">
                    <select 
                        id="incoming.phone_code" 
                        class="flex items-center h-10 pl-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" 
                        name="incoming.phoneCode" 
                        wire:model='incoming.phone_code'
                    >
                        <option value="0412">0412</option>
                        <option value="0414">0414</option>
                        <option value="0412">0416</option>
                        <option value="0424">0424</option>
                        <option value="0426">0426</option>
                    </select>
                    <p class="block p-2 font-extrabold">-</p>
                    <input 
                        id="incoming.phone_number" 
                        class="{{ $input }}"
                        name="incoming.phone_number" 
                        type="tel" 
                        x-model='$wire.incoming.phone_number'
                        x-on:input="$wire.incoming.phone_number = updateValue($wire.incoming.phone_number, 7)" 
                        wire:model="incoming.phone_number"
                    />
                </div>
            </div>     

            {{-- todo Job title --}}
            <div class="w-full">
                <label class="{{ $label }}" for="incoming.job_title">Cargo:</label>
                <x-input-error for='incoming.job_title_id'/>

                <select 
                    class="{{ $input }}" 
                    id="incoming.job_title" 
                    wire:model="incoming.job_title_id"
                >
                <option selected style="display: none">Selecciona una opcion...</option>
                    @foreach ($job_titles as $job_title)
                        <option value="{{$job_title->id}}">{{$job_title->name}}</option>                
                    @endforeach
                </select>
            </div>
            
        </div>

        {{-- todo Buttons --}}
        <div class="flex justify-center w-full mt-2">
            <x-button type='button' class="mr-1 bg-red-400" wire:click="restartIncoming">Limpiar</x-button>
            <x-button type='button' class="ml-1 bg-green-600" wire:click="verifyIncoming">Verificar</x-button>
        </div>

        {{-- todo All Erros --}}
        @if ($incoming->verified == 1)            
            <div class="px-4 py-3 mt-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md" role="alert">
                <strong class="font-bold">Todo OK!</strong>
                <br>
                <span class="block sm:inline">Todos los campos del <strong>Personal Entrante</strong> han sido escritos correctamente.</span>
            </div>
        @elseif ($incoming->verified == 2)
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
