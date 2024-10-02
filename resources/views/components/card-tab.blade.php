@props(['title', 'main' => false])

<li class="me-2">
    <button id="{{ $title }}-tab" type="button" role="tab" 
        class="inline-block p-4 hover:bg-gray-100 dark:hover:bg-gray-700 
        @if($main) text-blue-600 rounded-ss-lg dark:bg-gray-800  dark:text-blue-500 
        @else hover:text-gray-600  dark:hover:text-gray-300
        @endif"
        x-on:click="{{$title}} = active()"

    >
        {{ $title }}
    </button>
</li>