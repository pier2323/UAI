@props(['livewire', 'alpine'])

<div class="relative flex items-center max-w-[8rem]">

    {{-- todo decrement --}}
    <button 
    type="button" 
    id="decrement-button" 
    class="p-3 bg-gray-100 border border-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 rounded-s-lg h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
    x-on:click='{{ $alpine }}--'
    >
        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
        </svg>
    </button>

    {{-- todo number --}}
    <input 
    type="text" 
    id="quantity-input" 
    data-input-counter aria-describedby="helper-text-explanation" 
    class="bg-gray-50 p-1 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
    placeholder="999" 
    x-model="{{ $alpine }}"
    wire:model="{{ $livewire }}"
    required
    />

    {{-- todo increment --}}
    <button 
    type="button" 
    id="increment-button" 
    data-input-counter-increment="quantity-input" 
    class="p-3 bg-gray-100 border border-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 rounded-e-lg h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
    x-on:click='{{ $alpine }}++'
    >
        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
        </svg>
    </button>
</div>