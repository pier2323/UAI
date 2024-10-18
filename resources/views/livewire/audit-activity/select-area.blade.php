<div x-data="selectArea()">
    <label for="SelectArea" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Área de la Actuación Fiscal</label>

    <div x-show="isSelecting" class="flex w-full text-sm font-semibold text-gray-900 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
        
        <x-input wire:model="new" type="text" class="w-full h-full mr-3" />

        <div class="flex items-center justify-center px-3 mr-2 text-green-700 border border-green-300 rounded-full bg-green-50"
        wire:click="save" x-on:click="isSelecting = false">
            <svg class="w-4 h-4" aria-hidden="true" fill="none" viewBox="0 0 16 12">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
            </svg>
        </div>

        <div class="flex items-center justify-center px-3 text-red-700 border border-red-300 rounded-full bg-red-50"
        x-on:click="isSelecting = false">
            <svg height="24px" viewBox="0 -960 960 960" width="24px" fill="#bb3f3b">
                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
            </svg>
        </div>

    </div>
    <div x-show="!isSelecting">
        <x-dropdown width="w-44" contentClasses="py-1 bg-white absolute overflow-scroll max-h-72">
            <x-slot:trigger>
                <div class="select-none">
                    
                    <x-input-error for="selected" />
                    <input id="SelectArea" readonly
                    class="cursor-pointer text-center select-none font-semibold bg-gray-50 border border-gray-300 w-full text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hover:bg-slate-200"
                    wire:model='selected' placeholder="Selecciona un Área"/> 

                </div>
            </x-slot>
            <x-slot:content>
                <ul>

                    @foreach ($areas as $area)
                    <li class="block px-3 py-3 pl-5111 hover:bg-gray-100" 
                        x-on:click="$wire.selected = '{{ $area->name }}'"
                    >
                        {{$area->name}}
                    </li>
                    @endforeach
    
                    <li class="flex items-center justify-center block px-4 py-2 hover:bg-gray-100" x-on:click="isSelecting = true">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    </li>
    
                </ul>
            </x-slot>
        </x-dropdown>
    </div>


    <script>
        function selectArea() {
            return {
                isSelecting: false,
            }
        }
    </script>
</div>
