<div x-on:open-browser.window="$wire.open = true;" class="absolute">

    <x-dialog-modal id='browser' maxWidth='2xl' wire:model='open'>
        <x-slot:title>Buscador</x-slot>
        <x-slot:content>
 
            <div x-data="browserEmployees()" x-init="init()">

                {{-- todo browser input --}}
                <x-input 
                    placeholder="Buscar..." 
                    x-model="search" 
                    x-on:open-browser.window="filterEmployees($event.detail.employees)" 
                    x-on:delete-card.window="filterEmployees($event.detail.employees)"
                />

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

                    {{-- todo table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 flex justify-center">
                                    P00
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Coordinacion
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- todo rows --}}
                            <template x-for="item in filteredItems" :key="item.id">    
                                <tr class="border-b font-semibold hover:bg-gray-100 cursor-pointer select-none active:bg-gray-300" 
                                x-on:click="clickTableRows(item)">

                                    <td class="px-6 py-3" scope="row" x-text='item.p00'></td>
                                    <td class="px-6 py-3" x-text="`${item.first_name} ${item.first_surname}`"></td>
                                    <td class="px-6 py-3" x-text="item.uai.name"></td>

                                </tr>
                            </template>

                            {{-- todo messages not found --}}
                            <template x-if="filteredItems.length === 0">
                                <tr>
                                    <td align="center" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-400" colspan="3">No se encontraron resultados</td>
                                </tr>                              
                            </template>
                        </tbody>
                    </table>
                    <div x-show="search.length === 0" class="m-3 flex justify-center align-middle">

                        {{-- todo numbers below --}}
                        <template x-for="number in pages.length" :key='number'>
                                <button 
                                    class= "border rounded-full p-2 flex justify-center align-middle h-10 w-10 font-bold mx-3" 
                                    type="button" 
                                    x-on:click="page = number - 1" 
                                    x-text="number" 
                                    x-bind:class="page === number - 1 ? 'bg-blue-300': 'hover:bg-slate-100 active:bg-blue-200'">
                                </button>
                        </template>
                    </div>
                </div>
            </div>
        

        </x-slot>
        <x-slot:footer>
            <x-button x-on:click="$wire.open = false">cerrar</x-button>
        </x-slot>
    </x-dialog-modal>

    <script>
        function browserEmployees(){
            return {
                allEmployees: [],
                search: '',
                pages: [],
                page: 0,
                items: '',
                
                init() {
                    this.items = @js($employees); 
                    this.pages = this.paginate(this.items, 4); 
                    this.allEmployees = this.items;
                },

                get filteredItems() {
                    return (this.search !== "" ? this.items :this.pages[this.page]).filter(
                        item => {
                            fullname = `${item.first_name} ${item.first_surname}`
                            return fullname.includes(this.search) 
                            || fullname.includes(this.search.toUpperCase()) 
                            || `${item.p00}`.includes(this.search) 
                            || item.uai.name.includes(this.search)                                
                        }
                    );
                },

                paginate(items = this.items, parts = 10) {
                    const length = Math.ceil(items.length / parts); // todo Math.ceil() return up value

                    return items.reduce((result, element, index) => {
                        const indexLength = Math.floor(index / length); // todo Math.floor() return near value
                        result[indexLength] = result[indexLength] || []; // validate the page
                        result[indexLength].push(element);
                        return result;
                    }, []);
                },

                filterEmployees(employeesSelected) {
                    employeesSelected = new Set(employeesSelected)
                    this.items = this.allEmployees.filter(item => {
                        for (const employee of employeesSelected) {
                            if (employee.id === item.id) {
                                return false
                            }
                        }
                        return true
                    })

                    this.pages = this.paginate(this.items, this.items.length / 10)
                },

                reset() {
                    this.search = ''
                    this.page = 0
                },

                clickTableRows({ id }) {
                    @this.open = false;
                    @this.dispatch('add-card', {id: id});
                    this.reset()
                }
            }
        }
    </script>
</div>
















