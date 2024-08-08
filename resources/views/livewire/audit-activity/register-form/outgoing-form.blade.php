<script src="js/auditActivity/registerFormScript/outgoing.js" defer></script>

<div x-data='outgoing()'>
    <x-button class="w-24 flex justify-center" type='button' x-on:click="isOpened = !isOpened">Saliente</x-button>
    <x-notification-error on='query_error_outgoing'>{{$outgoing->errorMessage}}</x-notification-error>
    <x-secondary-button 
        class="ml-4" 
        type='button' 
        x-on:click="$wire.outgoing.query = prompt('Ingresa el p00 del personal saliente para buscar')" 
        wire:click="queryOutgoing"
    >
        Consultar Saliente
    </x-secondary-button>
    
    <div class="section p-2 overflow-hidden" x-bind:class="isOpened ? 'active' : ''">


        {{-- todo P00 --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="outgoing.p00">P00:</label>
            <x-input-error for='outgoing.p00'/>
            <div class="flex">
                <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm" >P00</div>
                
                <p class="font-extrabold block p-2">-</p>
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
        <div class="mb-3">
            <label class="{{ $label }}" for="outgoing.personal_id">Numero de Cedula:</label>
            <x-input-error for='outgoing.personal_id'/>
            <div class="flex">
                <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm" >V</div>
                
                <p class="font-extrabold block p-2">-</p>
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


        {{-- todo first_name --}}
        <div class="bg mb-3">
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
        <div class="mb-3">
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
        
        {{-- todo first_surname --}}
        <div class="mb-3">
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
        <div class="mb-3">
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

        {{-- todo Phone --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="outgoing.phone_number">Teléfono:</label>
            <x-input-error for='outgoing.phone_code'/>
            <x-input-error for='outgoing.phone_number'/>
            <div class="flex">
                <select 
                    class="flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm" 
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
                <p class="font-extrabold block p-2">-</p>
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
            
        {{-- todo Gmail --}}
        <div class="mb-3">
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
        <div class="mb-3">
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

        {{-- todo Job title --}}
        <div class="mb-3">
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
        <div class="w-full mt-2 flex justify-center">
            <x-button type='button' class="bg-red-400 mr-1" wire:click="restartOutgoing">Limpiar</x-button>
            <x-button type='button' class="bg-green-600 ml-1" wire:click="verifyOutgoing">Verificar</x-button>
        </div>

        {{-- todo All Erros --}}
        @if ($outgoing->verified == 1)            
            <div class="bg-teal-100 border-t-4 mt-3 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <strong class="font-bold">Todo OK!</strong>
                <br>
                <span class="block sm:inline">Todos los campos del <strong>Personal Saliente</strong> han sido escritos correctamente.</span>
            </div>
        @elseif ($outgoing->verified == 2)
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
