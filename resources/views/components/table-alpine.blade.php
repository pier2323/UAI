@props([
    'name',
    'data',
    'nameColumns' => [],
    'nameColumnId',
    'eventRow' => null,
    'customTable' => false,
    'browser' => false,
])

<div x-data="{{ $name }}" x-init="start(@js($data), $data, {{$browser}})" class="p-3">

    @if($browser)
    <div class="flex justify-between pr-10 mb-4">

        {{-- todo browser --}}
        <x-input class="ml-6" type="search" x-model="query" placeholder='Buscar...' />

    </div>
    @endif

    <ul class="@if($customTable) {{$name}}-header-grid-custom @else justify-center mt-4 grid grid-cols-{{count($nameColumns)}} gap-y-3 @endif">

        {{-- todo head --}}
        @foreach ($nameColumns as $column => $value)
            <li class="font-semibold text-center border-b border-b-slate-300"> {{ $column }} </li>
        @endforeach

        {{-- todo body --}}
        <template x-for="row in filtereds" :key="row.{{$nameColumnId}}">

            <li style="grid-column: span 5" class="
            cursor-pointer select-none hover:bg-gray-100 active:bg-gray-300
            @if($customTable) {{$name}}-rows-alpine-grid-custom
            @else justify-center mt-4 grid grid-cols-{{count($nameColumns)}} gap-y-3
            @endif justify-items-center items-center"
            @isset($eventRow) {{$eventRow}}="{{$attributes[$eventRow]}}" @endisset>

                @foreach ($nameColumns as $column => $value)

                    <div x-text="row.{{$value}}" class='{{$name}}-cell-alpine-grid-custom {{"$name-$column-$value"}}'></div>

                @endforeach

            </li>

        </template>

        {{-- todo messages not found --}}
        <template x-if="typeof filtereds !== 'undefined' ? filtereds.length === 0 : false">
            <li style="grid-column: span 5" class="px-6 py-4 font-medium text-gray-900 bg-gray-400 whitespace-nowrap">
                <div class="text-center">No se encontraron resultados de su busqueda</div>
            </li>
        </template>

        <template x-if="typeof filtereds === 'undefined'">
            <li style="grid-column: span 5" class="px-6 py-4 font-medium text-gray-900 bg-gray-200 whitespace-nowrap">
                <div class="text-center">Vacío</div>
            </li>
        </template>

    </ul>

    <hr class="mt-4">

    {{-- todo numbers below --}}
    <div x-show="query.length === 0" class="flex justify-center m-3 align-middle">
        <template x-for="number in pages.length" :key='"page-"+number'>
            <button
                class= "flex justify-center w-10 p-2 mx-3 font-bold align-middle border rounded-full min-h-13 max-h-20"
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

            start(data, {filtered}, browser) {
                this.items = data;
                this.pages = this.paginate(this.items, 10);

                if (browser) {
                    this.newFiltered = filtered;
                }
                else{
                    this.newFiltered = (query, items, pages, currentPage) => {
                        return this.pages[this.currentPage];
                    };
                }
            },

            getCurrentPage(query, items, pages, currentPage){
                return this.pages[this.currentPage];
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
