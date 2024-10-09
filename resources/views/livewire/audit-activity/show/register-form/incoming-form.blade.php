<div x-data='incoming' class="p-3">
    <h1 class="mt-1 mb-4 ml-10 text-2xl">Entrante</h1><hr>
    <div>

        {{-- todo p00 & personalid --}}
        <div class="flex gap-4 mb-4">

            {{-- todo P00 --}}
            <x-input-text-handover property="incoming.p00" title="P00" input="updateValue" :readonly="$modelsHandoverDocument">
                <x-slot:prefix>
                    <div class="flex items-center h-10 p-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" >P00</div>
                        
                    <p class="block p-2 font-extrabold">-</p>
                </x-slot>
            </x-input-text-handover>
            
            {{-- todo Personal ID --}}
            <x-input-text-handover property="incoming.personal_id" title="Numero de Cedula" input="updateValue" limit="8" :readonly="$modelsHandoverDocument">
                <x-slot:prefix>
                    <div class="flex items-center h-10 p-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" >V</div>
                        
                    <p class="block p-2 font-extrabold">-</p>
                </x-slot>
            </x-input-text-handover>
            
        </div>
        <hr class="mb-4">

        {{-- todo fullname --}}
        <div role="fullname" class="mb-4">

            {{-- todo names --}}
            <div role="names" class="flex justify-between gap-4">

                {{-- todo first_name --}}
                <x-input-text-handover property="incoming.first_name" title="Primer Nombre" :readonly="$modelsHandoverDocument"/>
               
                {{-- todo second_name --}}
                <x-input-text-handover property="incoming.second_name" title="Segundo Nombre" :readonly="$modelsHandoverDocument"/>

            </div>

            {{-- todo surnames --}}
            <div role="surnames" class="flex justify-between gap-4">

                {{-- todo first_surname --}}
                <x-input-text-handover property="incoming.first_surname" title="Primer Apellido" placeholder="VANEGAS" :readonly="$modelsHandoverDocument"/>

                {{-- todo second_surname --}}
                <x-input-text-handover property="incoming.second_surname" title="Segundo Apellido" placeholder="GARCÍA" :readonly="$modelsHandoverDocument"/>

            </div>
        </div>
        <hr class="mb-4">

        {{-- todo emails --}}
        <div class="flex gap-4">
            
            {{-- todo Gmail --}}
            <x-input-text-handover property="incoming.gmail" title="Correo UAI gmail" custom :readonly="$modelsHandoverDocument"/>
            
            {{-- todo Email cantv --}}
            <x-input-text-handover property="incoming.email_cantv" title="Correo Institucional" custom :readonly="$modelsHandoverDocument"/>
            
        </div>

        {{-- todo Phone & JobTitle --}}
        <div class="flex gap-4">


            {{-- todo Phone --}}

            @if (isset($modelsHandoverDocument))
                <x-input-text-handover property="incoming.phone" title="Telefono" :readonly="$modelsHandoverDocument"/>
            @else
                <x-input-text-handover property="incoming.phone_number" title="Telefono">

                    <x-slot:prefix>
                        <select 
                            class="flex items-center h-10 pl-3 text-sm font-normal text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border focus:border-indigo-500 focus:outline-none" 
                            name="phone_code" 
                            id="phone_code" 
                            wire:model='incoming.phone_code'
                        >
                            <option value="0412">0412</option>
                            <option value="0414">0414</option>
                            <option value="0416">0416</option>
                            <option value="0424">0424</option>
                            <option value="0426">0426</option>
                        </select>
                            
                        <p class="block p-2 font-extrabold">-</p>
                    </x-slot>
                    
                </x-input-text-handover>
            @endif

            {{-- todo Job title --}}
            <x-input-text-handover property="incoming.job_title" title="Cargo" :readonly="$modelsHandoverDocument" />

        </div>

    </div>

    @empty($modelsHandoverDocument)
        
        {{-- todo All Erros --}}
        <div class="flex justify-center w-full mt-2">
            <x-button type='button' class="ml-1 bg-green-600" wire:click="verify('incoming')">Verificar</x-button>
        </div>

        @if ($incoming->verified)
            <div class="px-4 py-3 mt-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md" role="alert">
                <strong class="font-bold">Todo OK!</strong>
                <br>
                <span class="block sm:inline">Todos los campos del <strong>Personal Entrante</strong> han sido escritos correctamente.</span>
            </div>
        @endif

        @if ($errors->any() && !$incoming->verified)
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

    @endempty

</div>


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
