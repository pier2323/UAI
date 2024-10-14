@props(['tab', 'title'])

<li class="me-2">
    <button id="{{ $title }}-tab" type="button" role="tab" 
        class="inline-block p-4 hover:bg-gray-100 dark:hover:bg-gray-700"
        :class="{{ $tab }} ? 'text-blue-600 rounded-ss-lg dark:bg-gray-800  dark:text-blue-500': 'hover:text-gray-600  dark:hover:text-gray-300'"
        x-on:click="{{ $tab }} = active()"

    >
        {{ $title }}
    </button>
</li>