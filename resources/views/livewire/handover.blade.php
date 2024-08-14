<div>
    <x-section-basic>

        <div x-on:open-browser.window="$wire.open = true;">
            <h1 x-on:add-card.window='$wire.hola($event.detail.id)'></h1>
            <div x-data="browser()" x-init="items = {{ $AuditActivity }};
            pages = paginate(items, 4);">

                <x-input x-model="search" placeholder="Buscar..." />
                <p x-text='search'></p>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                 
                    {{-- todo table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 ">
                                    Código
                                </th>
                                <th style="padding-left: 111px;">
                                    Objetivo
                                </th>
                                <th scope="col" class="px-6 py-3 ">
                                    Código de la Actuación
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipo de Auditoria
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Mes Inicio
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Mes fin
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    comisión Auditoria
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Área UAI Encargada
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                            {{-- todo rows --}}
                            <template x-for="item in filteredItems" :key="item.id">
                                <tr class="border-b font-semibold hover:bg-gray-100 cursor-pointer select-none active:bg-gray-300"
                                    x-on:click="$dispatch('add-card', {id: item.id}); $wire.open = false; reset()">

                                    {{-- <td class="px-6 py-3" x-text="`${item.first_name} ${item.first_surname}`"></td> --}}
                                    <td class="px-6 py-3" x-text="item.id "></td>
                                    <td class="px-6 py-3" x-text="item.description"></td>
                                    <td class="px-6 py-3" x-text="item.code"></td>
                                    <td class="px-6 py-3" x-text="item.type_audit.code"></td>
                                    <td class="px-6 py-3" x-text="item.month_start "></td>
                                    <td class="px-6 py-3" x-text="item.month_end  "></td>
                                    {{-- <td class="px-6 py-3" x-text=""></td> --}}

                                </tr>

                            </template>

                            {{-- todo messages not found --}}
                            <template x-if="filteredItems.length === 0">
                                <tr>
                                    <td align="center"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-400"
                                        colspan="3">No se encontraron resultados</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div x-show="search.length === 0" class="m-3 flex justify-center align-middle">

                        {{-- todo numbers below --}}
                        <template x-for="number in pages.length" :key='number'>
                            <button
                                class= "border rounded-full p-2 flex justify-center align-middle h-10 w-10 font-bold mx-3"
                                type="button" x-on:click="page = number - 1" x-text="number"
                                x-bind:class="page === number - 1 ? 'bg-blue-300' : 'hover:bg-slate-100 active:bg-blue-200'">
                            </button>
                        </template>
                    </div>
                </div>
            </div>


    </x-section-basic>

    <script>
        function browser() {
            return {
                search: '',
                pages: [],
                page: 0,
                items: '',



                get filteredItems() {
                    return (this.search !== "" ? this.items : this.pages[this.page])
                        .filter(
                            item => {
                                return item.type_audit.code.includes(this.search) ||
                                    item.objective.includes(this.search) ||
                                    item.objective.includes(this.search.toUpperCase()) ||
                                    item.objective.includes(this.capitalize(this.search)) ||
                                    item.code.includes(this.search.toUpperCase())
                            }
                        )
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


                capitalize(string) {
                    return string.replace(/\b[a-z]/g, (letra) => letra.toUpperCase());
                }
            }
        }
    </script>



</div>

</div>
