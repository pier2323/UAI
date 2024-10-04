<div x-data>
    <label for="SelectTypeAudit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Actuacion Fiscal</label>

    <div>

    <x-dropdown width="w-44"  contentClasses="py-1 bg-white absolute overflow-scroll max-h-72">

        <x-slot:trigger>
            <div class="select-none ">
                <input id="SelectTypeAudit" readonly 
                class="cursor-pointer text-center select-none font-semibold bg-gray-50 border border-gray-300 w-full text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hover:bg-slate-200"
                wire:model='selected' placeholder="Seleccione un Tipo" /> 
            </div>
        </x-slot>

        <x-slot:content>
            <ul>

                @foreach ($typeAudits as $typeAudit)
                <li class="block px-3 py-2 pl-1 hover:bg-gray-100" 
                    x-on:click="$wire.selected = '{{ $typeAudit->name }}'"
                >
                    {{$typeAudit->name}}
                </li>
                @endforeach

            </ul>
        </x-slot>
    </x-dropdown>
    </div>

</div>