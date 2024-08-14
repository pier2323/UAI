<x-section-basic class="pb-5 pl-5 flex flex-col justify-center align-middle">
    <h1 class="text-3xl font-bold dark:text-white">Comision<small class="ms-2 font-semibold text-gray-500 dark:text-gray-400">de la Acta de Entrega</small></h1>

    <hr class="mb-4">
    
    <div class="flex justify-center">

        {{-- todo cards --}}
        <div class="grid grid-cols-4 auto-rows-fr gap-x-8 gap-y-5 justify-items-center w-5/6  min-h-56" x-data="card()" x-on:saving.window='$wire.prepare(employees)'>
            
            {{-- todo x-for --}}
            <template class="w-full" x-for="(card, index) in employees" :key="'card-'+index">

                <div class="w-full">
                    
                    {{-- todo one card --}}
                    <x-card-profile class="cards-profile">        
                        <div class="flex justify-between mb-1">

                            {{-- todo Select Role  --}}
                            <select x-model='card.role' :id="'browser-card-select-' + index" name="role" class="bg-gray-50 border-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit">
                                <option value="1">Coordinador</option>
                                <option value="2" selected>Auditor</option>
                            </select>

                            {{-- todo closeButton --}}
                            <button class="inline-block p-1 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-2 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm"
                            type="button" 
                            x-on:click="clickCloseButton(card)">
                                <span class="sr-only">Open dropdown</span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#5f6368"><path d="m249-207-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg>
                            </button>
                        
                        </div>
                    </x-card-profile>
                </div>

            </template>

            {{-- todo card Add --}}
            @push('modals') <livewire:employee.browser /> @endpush

            {{-- todo button add card --}}
            <div class="w-1/2 h-1/2 self-center bg-gray-200 border border-gray-200 rounded-full shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 active:bg-green-100"
            x-on:click="clickAddCardButton()" 
            x-on:add-card.window="resolve($wire.addCard($event.detail.id)); ">
                <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg class="w-full h-full" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 12H20M12 4V20" stroke="#ccc" stroke-width=".9" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            
        </div>
    </div>
</x-section-basic>

@push('script')    
    <script>
        function card() {
            return {
                employees: [],

                remove(key) {                
                    this.employees = this.employees.filter(employee => employee.data !== key.data)
                },

                resolve(promise) {
                    promise.then(data => {
                        
                        this.employees.push({
                            data: data,
                            role: 1,
                        })
                        
                    })
                },

                clickAddCardButton() {
                    datas = this.employees.map( employees => employees.data );
                    @this.dispatch('open-browser', { employees: datas }); 
                },

                clickCloseButton(card) {
                    this.remove(card); 
                    @this.dispatch('delete-card', { employees: this.employees }); 
                    @this.deleteCard(card.id);
                }
                
            }
    }
    </script>
@endpush