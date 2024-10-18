@props([
    'name', 
    'data', 
    'nameColumns' => [], 
    'nameColumnId',
    'eventRow' => null,
    'customTable' => false,
])

<div x-data="{{ $name }}" x-init="start(@js($data), $data)" class="p-3">
                        
    <div class="flex justify-between pr-10 mb-4">

        {{-- todo browser --}}
        <x-input class="ml-6" type="search" x-model="query" placeholder='Buscar...' />

    </div>


    <ul class="@if($customTable) table-alpine-grid-custom @else justify-center mt-4 grid grid-cols-{{count($nameColumns)}} gap-y-3 @endif">

        {{-- todo head --}}
        @foreach ($nameColumns as $column => $value)
            <li class="text-center border-b border-b-slate-300 font-semibold"> {{ $column }} </li>
        @endforeach
        
        {{-- todo body --}}
        <template x-for="row in filtereds" :key="row.{{$nameColumnId}}">
            
            <li style="grid-column: span 5" class="
            cursor-pointer select-none hover:bg-gray-100 active:bg-gray-300 
            @if($customTable) rows-alpine-grid-custom 
            @else justify-center mt-4 grid grid-cols-{{count($nameColumns)}} gap-y-3 
            @endif justify-items-center items-center" 
            @isset($eventRow) {{$eventRow}}="{{$attributes[$eventRow]}}" @endisset>

                @foreach ($nameColumns as $column => $value)
                    
                    <div x-text="row.{{$value}}" class='cell-alpine-grid-custom {{"$column-$value"}}'></div> 

                @endforeach

            </li>
            
        </template>

        {{-- todo messages not found --}}
        <template x-if="typeof filtereds !== 'undefined' ? filtereds.length === 0 : false">
            <li style="grid-column: span 5" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-400">
                <div class="text-center">No se encontraron resultados de su busqueda</div>
            </li>                              
        </template>

        <template x-if="typeof filtereds === 'undefined'">
            <li style="grid-column: span 5" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-200">
                <div class="text-center">Vacío</div>
            </li>                              
        </template>
        
    </ul>

    <hr class="mt-4">

    {{-- todo numbers below --}}
    <div x-show="query.length === 0" class="m-3 flex justify-center align-middle">
        <template x-for="number in pages.length" :key='"page-"+number'>
            <button 
                class= "border rounded-full p-2 flex justify-center align-middle min-h-13 max-h-20 w-10 font-bold mx-3" 
                type="button" 
                x-on:click="currentPage = number - 1" 
                x-text="number" 
                x-bind:class="currentPage === number - 1 ? 'bg-blue-300': 'hover:bg-slate-100 active:bg-blue-200'">
            </button>
        </template>
    </div>
    

</div>


@script
<script>
    Alpine.data('{{ $name }}', () => {
        return {
            query: '',
            items: {},
            pages: [],
            currentPage: 0,
            newFiltered: null,

            start(data, {filtered}) {
                this.items = data; 
                this.pages = this.paginate(this.items, 10);
                this.newFiltered = filtered;
            },

            get filtereds() {
                return this.newFiltered(this.query, this.items, this.pages, this.currentPage);
            },
            
            paginate(items = this.items, mini = 10) {
                const length = Math.ceil(items.length /(items.length/mini)); // todo Math.ceil() return up value

                return items.reduce((result, element, index) => {
                    const indexLength = Math.floor(index / length); // todo Math.floor() return near value
                    result[indexLength] = result[indexLength] || []; // validate the page
                    result[indexLength].push(element);
                    return result;
                }, []);
            },
        }
    })
</script>
@endscript