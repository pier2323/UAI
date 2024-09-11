@push('script')  
@script
<script>
    
Alpine.data('outgoing', () => {
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



<div x-data='outgoing' class="w-full">
    <h1 class="mt-4 mb-3 ml-10 text-2xl">Saliente</h1>
    <div class="w-full">
    {{-- <x-notification-error on='query_error_outgoing'>{{$outgoing->errorMessage}}</x-notification-error> --}}
    {{-- <x-secondary-button 
        class="ml-4" 
        type='button' 
        x-on:click="$wire.outgoing.query = prompt('Ingresa el p00 del personal saliente para buscar')" 
        wire:click="queryOutgoing"
    >
        Consultar Saliente
    </x-secondary-button> --}}
    

        {{-- todo p00 & personalid --}}
        <div class="flex gap-4 mb-4">
            {{-- todo P00 --}}
            <div class="w-full">
                <label class="{{ $label }}" for="outgoing.p00">P00:</label>
                <x-input-error for='outgoing.p00'/>
                <div class="flex">
                    <div class="flex items-center h-10 p-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" >P00</div>
                    
                    <p class="block p-2 font-extrabold">-</p>
                    <input 
                        id="outgoing.p00" 
                        name="outgoing.p00" 
                        {{-- required --}}
                        class="{{ $input }}"
                        type="text" 
                        x-on:input="$wire.outgoing.p00 = updateValue($wire.outgoing.p00, 6)" 
                        x-model="$wire.outgoing.p00"
                        wire:model.defer="outgoing.p00"
                    >
                </div>
            </div>

            {{-- todo Personal ID --}}
            <div class="w-full">
                <label class="{{ $label }}" for="outgoing.personal_id">Numero de Cedula:</label>
                <x-input-error for='outgoing.personal_id'/>
                <div class="flex">
                    <div class="flex items-center h-10 p-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" >V</div>
                    
                    <p class="block p-2 font-extrabold">-</p>
                    <input 
                        id="outgoing.personal_id" 
                        name="outgoing.personal_id" 
                        {{-- required --}}
                        class="{{ $input }}"
                        type="text" 
                        x-on:input="$wire.outgoing.personal_id = updateValue($wire.outgoing.personal_id, 6)" 
                        x-model="$wire.outgoing.personal_id"
                        wire:model.defer="outgoing.personal_id"
                    >
                </div>
            </div>
        </div>
        <hr class="mb-4">

        {{-- todo fullname --}}
        <div role="fullname" class="mb-4">

            {{-- todo names --}}
            <div role="names" class="flex justify-between gap-4">
                {{-- todo first_name --}}
                <div class="w-full">
                    <label class="{{ $label }}" for="outgoing.first_name">Primer Nombre:</label>
                    <x-input-error for='outgoing.first_name'/>
                    <input 
                        id="outgoing.first_name" 
                        wire:model="outgoing.first_name"
                        class="{{ $input }}" 
                        name="outgoing.first_name" 
                        placeholder="JENBLUK" 
                        type="text"
                        x-model="$wire.outgoing.first_name"
                        x-on:input="$wire.outgoing.first_name = transformedInput($wire.outgoing.first_name)" 
                    />
                </div>

                {{-- todo second_name --}}
                <div class="w-full">
                    <label class="{{ $label }}" for="outgoing.second_name">Segundo Nombre:</label>
                    <x-input-error for='outgoing.second_name'/>
                    <input 
                    id="outgoing.second_name"
                    class="{{ $input }}" 
                    name="outgoing.second_name" type="text" 
                    x-bind:class="markedSecondName ? 'bg-gray-200' : ''"
                    x-bind:disabled="markedSecondName" 
                    x-bind:required="markedSecondName" 
                    x-model="$wire.outgoing.second_name"
                    x-on:input="$wire.outgoing.second_name = transformedInput($wire.outgoing.second_name)" 
                    wire:model="outgoing.second_name" 
                    />

                    {{-- todo button No Aplica --}}
                    <div>
                        <label for="outgoing.second_name-checkbox">No aplica</label>

                        <input 
                            id="outgoing.second_name-checkbox" 
                            type="checkbox"
                            x-on:change="{ marked: markedSecondName, inputValue: $wire.outgoing.second_name } = toggleMark(markedSecondName)" 
                        />
                    </div>
                </div>
            </div>

            {{-- todo surnames --}}
            <div role="surnames" class="flex justify-between gap-4">
                {{-- todo first_surname --}}
                <div class="w-full">
                    <label class="{{ $label }}" for="outgoing.first_surname">Primer Apellido:</label>
                    <x-input-error for='outgoing.first_surname'/>
                    <input 
                        id="outgoing.first_surname"
                        name="outgoing.first_surname"
                        class="{{ $input }}" 
                        placeholder="VANEGAS" 
                        type="text" 
                        x-model="$wire.outgoing.first_surname"
                        x-on:input="$wire.outgoing.first_surname = transformedInput($wire.outgoing.first_surname)" 
                        wire:model="outgoing.first_surname" 
                        {{-- required  --}}
                    />
                </div>

                {{-- todo second_surname --}}
                <div class="w-full">
                    <label class="{{ $label }}" for="outgoing.second_surname">Segundo Apellido:</label>
                    <x-input-error for='outgoing.second_surname'/>
                    <input 
                        id="outgoing.second_surname"
                        name="outgoing.second_surname" 
                        class="{{ $input }}" 
                        placeholder="GARCÍA" 
                        type="text"
                        x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''" 
                        x-bind:disabled="markedSecondSurname"
                        x-bind:required="markedSecondSurname" 
                        x-model="$wire.outgoing.second_surname"
                        x-on:input="$wire.outgoing.second_surname = transformedInput($wire.outgoing.second_surname)" 
                        wire:model="outgoing.second_surname" 
                    />
                    <div>
                        <label for="outgoing.second_surname-checkbox">No aplica</label>
                        <input 
                            id="outgoing.second_surname-checkbox" 
                            type="checkbox"
                            x-on:change="{ marked: markedSecondSurname, inputValue: $wire.outgoing.second_surname } = toggleMark(markedSecondSurname)"
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
                <label class="{{ $label }}" for="outgoing.gmail">Correo UAI gmail:</label>
                <x-input-error for='outgoing.gmail'/>
                <input 
                    id="outgoing.gmail" 
                    name="outgoing.gmail"
                    class="{{ $input }}" 
                    type="email"
                    wire:model="outgoing.gmail" 
                    placeholder="jenblukvanegas@gmail.com" 
                    x-model='$wire.outgoing.gmail'
                >
            </div>
            
            {{-- todo Email cantv --}}
            <div class="w-full">
                <label class="{{ $label }}" for="outgoing.email_cantv">Correo Institucional:</label>
                <x-input-error for='outgoing.email_cantv'/>
                <input 
                    id="outgoing.email_cantv" 
                    name="outgoing.email_cantv"
                    class="{{ $input }}" 
                    placeholder="jvane01@cantv.com.ve" 
                    type="email"
                    wire:model="outgoing.email_cantv"
                    x-model='$wire.outgoing.email_cantv'
                >
            </div>
        </div>

        {{-- todo Phone & JobTitle --}}
        <div class="flex gap-4">
            {{-- todo Phone --}}
            <div class="w-full">
                <label class="{{ $label }}" for="outgoing.phone_number">Teléfono:</label>
                <x-input-error for='outgoing.phone_code'/>
                <x-input-error for='outgoing.phone_number'/>
                <div class="flex">
                    <select 
                        class="flex items-center h-10 pl-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" 
                        name="phone_code" 
                        id="phone_code" 
                        wire:model='outgoing.phone_code'
                    >
                        <option value="0412">0412</option>
                        <option value="0414">0414</option>
                        <option value="0416">0416</option>
                        <option value="0424">0424</option>
                        <option value="0426">0426</option>
                    </select>
                    <p class="block p-2 font-extrabold">-</p>
                    <input 
                        id="outgoing.phone_number" 
                        name="outgoing.phone_number" 
                        class="{{ $input }} flex-grow"
                        type="tel" 
                        wire:model="outgoing.phone_number"
                        x-on:input="$wire.outgoing.phone_number = updateValue($wire.outgoing.phone_number, 7)" 
                        x-model='$wire.outgoing.phone_number'
                    />
                </div>
            </div>

            {{-- todo Job title --}}
            <div class="w-full">
                <label class="{{ $label }}" for="outgoing.job_title_id">Cargo:</label>
                <x-input-error for='outgoing.job_title_id'/>

                <select 
                    id="outgoing.job_title_id" 
                    class="{{ $input }}" 
                    wire:model="outgoing.job_title_id"
                >
                <option selected style="display: none">Selecciona una opcion...</option>
                    @foreach ($job_titles as $job_title)
                        <option value="{{$job_title->id}}">{{$job_title->name}}</option>                
                    @endforeach
                </select>
            </div>
        </div>

        {{-- todo Departament --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="outgoing.departament_id">Unidad de Adscripcion:</label>
            <x-input-error for='outgoing.departament_id'/>

            <select 
                id="outgoing.departament_id" 
                class="{{ $input }}" 
                wire:model="outgoing.departament_id"
            >
            <option selected style="display: none">Selecciona una opcion...</option>
                @foreach ($departaments as $departament)
                    <option value="{{$departament->id}}">{{$departament->name}}</option>                
                @endforeach
            </select>
        </div>

        {{-- todo Buttons --}}
        <div class="flex justify-center w-full mt-2">
            <x-button type='button' class="mr-1 bg-red-400" wire:click="restartOutgoing">Limpiar</x-button>
            <x-button type='button' class="ml-1 bg-green-600" wire:click="verifyOutgoing">Verificar</x-button>
        </div>

        {{-- todo All Erros --}}
        @if ($outgoing->verified == 1)            
            <div class="px-4 py-3 mt-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md" role="alert">
                <strong class="font-bold">Todo OK!</strong>
                <br>
                <span class="block sm:inline">Todos los campos del <strong>Personal Saliente</strong> han sido escritos correctamente.</span>
            </div>
        @elseif ($outgoing->verified == 2)
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
