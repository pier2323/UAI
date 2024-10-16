<div x-on:open_browser_handover.window="$wire.open = true;" class="absolute">

    <x-dialog-modal id='browser' maxWidth='2xl' wire:model='open'>
        <x-slot:title>Buscador</x-slot>
        <x-slot:content>
 
            <div x-data="browser()" x-init="init()">

                {{-- todo browser input --}}
                <x-input 
                    placeholder="Buscar..." 
                    x-model="search" 
                    {{-- x-on:open-browser.window="filterHandoverDocuments($event.detail.handoverDocuments)" 
                    x-on:delete-card.window="filterHandoverDocuments($event.detail.handoverDocuments)" --}}
                />

                <div class="relative mt-4 overflow-x-auto shadow-md sm:rounded-lg">

                    {{-- todo table --}}
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="flex justify-center px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Saliente
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Unidad que Entrega
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- todo rows --}}
                            <template x-for="item in filteredItems" :key="item.id">    
                                <tr class="font-semibold border-b cursor-pointer select-none hover:bg-gray-100 active:bg-gray-300" 
                                x-on:click="clickTableRows(item);">

                                    <td class="px-6 py-3" scope="row" x-text='item.id'></td>
                                    <td class="px-6 py-3" x-text="`${item.employee_outgoing.first_name} ${item.employee_outgoing.first_surname}`"></td>
                                    <td class="px-6 py-3" x-text="item.departament"></td>

                                </tr>
                            </template>

                            {{-- todo messages not found --}}
                            <template x-if="filteredItems.length === 0">
                                <tr>
                                    <td align="center" class="px-6 py-4 font-medium text-gray-900 bg-gray-400 whitespace-nowrap" colspan="3">No se encontraron resultados</td>
                                </tr>                              
                            </template>
                        </tbody>
                    </table>
                    <div x-show="search.length === 0" class="flex justify-center m-3 align-middle">

                        {{-- todo numbers below --}}
                        <template x-for="number in pages.length" :key='number'>
                                <button 
                                    class= "flex justify-center w-10 h-10 p-2 mx-3 font-bold align-middle border rounded-full" 
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

    @script
    <script>
        Alpine.data('browser', () => {
            return {
                    allHandoverDocuments: [],
                    search: '',
                    pages: [],
                    page: 0,
                    items: '',
                    
                    init() {
                        this.items = @js($handoverDocuments); 
                        this.pages = this.paginate(this.items); 
                        this.allHandoverDocuments = this.items;
                        console.log(this.pages)
                    },
    
                    get filteredItems() {
                        return (this.search !== "" ? this.items :this.items).filter(
                            item => {
                                fullname = `${item.employee_outgoing.first_name} ${item.employee_outgoing.first_surname}`
                                return fullname.includes(this.search) 
                                || fullname.includes(this.search.toUpperCase()) 
                                || `${item.id}`.includes(this.search) 
                                || item.departament.includes(this.search)                                
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
    
                    // filterHandoverDocuments(handoverDocumentsSelected) {
                    //     handoverDocumentsSelected = new Set(handoverDocumentsSelected)
                    //     this.items = this.allHandoverDocuments.filter(item => {
                    //         for (const handoverDocument of handoverDocumentsSelected) {
                    //             if (handoverDocument.id === item.id) {
                    //                 return false
                    //             }
                    //         }
                    //         return true
                    //     })
    
                    //     this.pages = this.paginate(this.items, this.items.length / 10)
                    // },
    
                    reset() {
                        this.search = ''
                        this.page = 0
                    },
    
                    clickTableRows({ id }) {
                        $wire.open = false;
                        $wire.$dispatch('add_handoverDocument', { id })
                    }
                }
            }
        )
        
    </script>
    @endscript
</div>
















