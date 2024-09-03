<div>
    {{-- todo these pages are intended to perform a components.blade or components livewire test --}}

    {{-- todo x-notification --}}
    {{-- <x-button x-on:click="$dispatch('button', {message: 'hola'})">button</x-button> --}}

    {{-- <x-notification on='button'/> --}}


    {{-- todo x-icon --}}
    <x-icon name='1k' img='bg-red-100 text-red-100'/>

    @script
    <script>
        console.log(Alpine);
        
        Alpine.data('hola', () => {
            return {
                como: 'estas'
            }
        })
    </script>
    @endscript

    <p x-data='hola' x-text="como"></p>

</div>
