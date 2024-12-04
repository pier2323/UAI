@props(['custom' => true, 'model', 'value', 'label'])

@php
    $id = 'year-radio-' . $value;
@endphp

<div @if(!$custom) {{$attributes}}
@else
class="flex items-center justify-center w-20 h-20 p-3 border-2 border-purple-600 rounded-full"
:class="$wire.year.forSelection == {{$value}}
? 'bg-blue-600'
: 'bg-gray-500 hover:bg-gray-400 active:bg-gray-600'"
x-on:click="$wire.year.forSelection = {{$value}}"
@endif >

    <input x-show="false" id='{{$id}}' type="radio" wire:model='{{$model}}' value="{{$value}}">
    <label
        class="text-2xl font-bold text-white"
        :class="$wire.year.forSelection == {{$value}} ? 'text-white': 'text-black'"
        for="{{$id}}"
    >
        {{ $value }}
    </label>

</div>
