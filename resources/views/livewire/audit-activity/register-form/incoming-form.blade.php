<script src="js/auditActivity/registerFormScript/incoming.js" defer></script>

<div x-data='incoming()' >
    <x-button type='button' class='w-24 flex justify-center' x-on:click="isOpened = !isOpened">Entrante</x-button>

    <x-notification-error on='query_error_incoming'>{{$incoming->errorMessage}}</x-notification-error>
    <x-secondary-button 
        class="ml-4" 
        type='button' 
        x-on:click="$wire.incoming.query = prompt('Ingresa el p00 del personal saliente para buscar')" 
        wire:click="queryIncoming"
    >
        Consultar Entrante
    </x-secondary-button>

    <div class="section p-2 overflow-hidden" x-bind:class="isOpened ? 'active' : ''"> 

        {{-- todo P00 --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="incoming.p00">P00:</label>
            <x-input-error for='incoming.p00'/>
            <div class="flex">
                <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm" >P00</div>
                
                <p class="font-extrabold block p-2">-</p>
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
        <div class="mb-3">
            <label class="{{ $label }}" for="incoming.personal_id">Numero de Cedula:</label>
            <x-input-error for='incoming.personal_id'/>
            <div class="flex">
                <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm" >V</div>
                
                <p class="font-extrabold block p-2">-</p>
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

        {{-- todo firstname --}}
        <div class="bg mb-3">
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
        <div class="mb-3">
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
        
        {{-- todo FirstSurname --}}
        <div class="mb-3">
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
        <div class="mb-3">
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

        {{-- todo Phone --}}
        <div class="mb-3">
            <label class="{{ $label }}" for="incoming.phone_number">Teléfono:</label>
            <x-input-error for='incoming.phone_code'/>
            <x-input-error for='incoming.phone_number'/>
            <div class="flex">
                <select 
                    id="incoming.phone_code" 
                    class="flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm" 
                    name="incoming.phoneCode" 
                    wire:model='incoming.phone_code'
                >
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0412">0416</option>
                    <option value="0424">0424</option>
                    <option value="0426">0426</option>
                </select>
                <p class="font-extrabold block p-2">-</p>
                <input 
                    id="incoming.phone_number" 
                    class="{{ $input }}"
                    name="incoming.phone_number" 
                    type="tel" 
                    x-model='incoming.phone_number'
                    x-on:input="$wire.incoming.phone_number = updateValue($wire.incoming.phone_number, 7)" 
                    wire:model="incoming.phone_number"
                />
            </div>
        </div>
            
        {{-- todo Gmail --}}
        <div class="mb-3">
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
        <div class="mb-3">
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

        {{-- todo Job title --}}
        <div class="mb-3">
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

        {{-- todo Buttons --}}
        <div class="w-full mt-2 flex justify-center">
            <x-button type='button' class="bg-red-400 mr-1" wire:click="restartIncoming">Limpiar</x-button>
            <x-button type='button' class="bg-green-600 ml-1" wire:click="verifyIncoming">Verificar</x-button>
        </div>

        {{-- todo All Erros --}}
        @if ($incoming->verified == 1)            
            <div class="bg-teal-100 border-t-4 mt-3 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <strong class="font-bold">Todo OK!</strong>
                <br>
                <span class="block sm:inline">Todos los campos del <strong>Personal Entrante</strong> han sido escritos correctamente.</span>
            </div>
        @elseif ($incoming->verified == 2)
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
