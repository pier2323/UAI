<?php

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

new class extends \Livewire\Volt\Component
{
    #[Modelable]
    public string $selected;

    #[Reactive]
    public Collection $items;

    public ?string $id;
    public ?string $placeholder;
    public ?string $title;
};

?>

<div>
    <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $title }}</label>

    <div>

    <x-dropdown width="w-44"  contentClasses="py-1 bg-white absolute overflow-scroll max-h-72">

        <x-slot:trigger>
            <div class="select-none ">
                <input id="{{ $id }}" readonly 
                class="cursor-pointer text-center select-none font-semibold bg-gray-50 border border-gray-300 w-full text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hover:bg-slate-200"
                wire:model='selected' placeholder="{{ $placeholder }}" /> 
            </div>
        </x-slot>

        <x-slot:content>
            <ul>

                @foreach ($items as $item)
                <li class="block px-3 py-2 pl-1 hover:bg-gray-100" 
                    x-on:click="$wire.selected = '{{ $item->name }}'"
                >
                    {{$item->name}}
                </li>
                @endforeach

            </ul>
        </x-slot>
    </x-dropdown>
    </div>
</div>
