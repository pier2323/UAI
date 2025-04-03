<?php

use Livewire\Attributes\Modelable;

new class extends \Livewire\Volt\Component
{
    public array $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    public string $id = 'hola';
    public string $class = '';
    public string $alpine = '';

    #[Modelable]
    public string $selected = '';
};

?>

<div>
    <div x-data="{{ $alpine }}">

        <input class="mb-2 cursor-pointer text-center select-none font-semibold bg-gray-50 border border-gray-300 max-w-fit text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 hover:bg-slate-200 {{ $class }}"
            placeholder="Seleciona un Mes"
            type="text" 
            readonly 
            id="{{ $id }}" 
            wire:model="selected"
            x-on:click="openDropdown()"
        >

        <div role="dropdown" x-show="dropdown" x-on:click.outside="closeDropdown()" class="grid block max-w-sm grid-cols-3 gap-2 p-3 bg-gray-100 border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <template x-for="(month, index) in months" :key="'month-'+index">
                <div class="flex items-center justify-center h-12 px-2 py-1 font-semibold bg-white border rounded-lg border-slate-700 hover:bg-blue-100 active:bg-blue-300"
                x-on:click="$wire.selected = month; closeDropdown()">
                    <span x-text="month"></span>
                </div>
            </template>
        </div>

    </div>
    <x-livewire>
        <script>
            Alpine.data(@js($alpine), () => {
                return {
                    
                    dropdown: false,
                    months: @js($months),

                    openDropdown() {
                        this.dropdown = true;
                    },

                    closeDropdown() {
                        this.dropdown = false;
                    },

                }
            })
        </script>
    </x-livewire>
</div>




