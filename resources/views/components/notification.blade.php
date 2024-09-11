
@props(['on', 'time' => '5000', 'theme' => 'checked'])

<div class="mt-2"
x-data='{
    show: false,
    open() { this.show = true },
    close() { this.show = false },
    isOpen() { return this.show === true },
}'
x-show='isOpen(show)'
x-on:{{$on}}.window='open(); setTimeout(()=> {show = false}, {{ $time }})'
x-transition:enter="transition-transform transition-opacity ease-out duration-500"
x-transition:enter-start="opacity-100 transform translate-x-20"
x-transition:leave="transition duration-500"
x-transition:leave-end="opacity-0 transform -translate-y-20"
>
    <div id="toast-default" wire:role="alert" class="flex items-center w-full max-w-xs p-4 bg-white border-2 rounded-lg shadow">
        {{-- todo icons --}}
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg">
            @if (isset($icon)) 
                {{ $icon }} {{-- class="w-4 h-4" --}}
            
            @else
                @switch($theme)

                    {{-- todo checked --}}
                    @case('checked')
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="sr-only">Check icon</span>
                    </div>
                    @break

                    {{-- todo error --}}
                    @case('error')
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                        </svg>
                        <span class="sr-only">Error icon</span>
                    </div>
                    @break

                    {{-- todo warning --}}
                    @case('warning')
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                        </svg>
                        <span class="sr-only">Warning icon</span>
                    </div>
                    @break
                    
                @endswitch
            @endif
        </div>

        {{-- todo message --}}
        <div class="text-sm font-normal me-4 ms-3">
                @if($slot->hasActualContent())

                    {{ $slot }}

                @else
                    <div x-data='{ message: null, bold: null}' x-on:{{$on}}.window='message = $event.detail.message; bold = $event.detail.bold'>
                        <strong x-text='bold'></strong>
                        <span x-text='message'></span>
                    </div>
                @endif
        </div>

        {{-- todo button close --}}
        <figure
        x-on:click="show = false"            
        type="button" 
        class="ms-auto -mx-1.5 -my-1.5 p-1.5 inline-flex items-center justify-center h-8 w-8">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </figure>
            
    </div>
</div>