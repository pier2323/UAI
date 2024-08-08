<x-section-basic class="pb-5 pl-5">
    <h1 class="text-3xl font-bold dark:text-white">Comision<small class="ms-2 font-semibold text-gray-500 dark:text-gray-400">de la Acta de Entrega</small></h1>

    <hr class="mb-4">
    
    {{-- todo cards --}}
    <div class="flex flex-row flex-wrap" x-data="card()">

        {{-- todo x-for --}}
        <template x-for="(card, index) in employees" :key="'card-'+index">
            
            {{-- todo one card --}}
            <x-card-profile class="cards-profile">        
                {{-- todo closeButton --}}
                <div class="flex justify-end px-2 pt-2" x-on:click="remove(card); $dispatch('delete-card', { employees: employees }); $wire.deleteCard(card.id)">
                    <button class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-2 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#5f6368"><path d="m249-207-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg>
                    </button>
                </div>
                
            </x-card-profile>

        </template>

        {{-- todo card Add --}}
        <livewire:employee.browser />
        <div class="w-full h-72 max-w-64 bg-gray-200  border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 active:bg-green-100"
        x-on:click="$dispatch('open-browser', { employees: employees })" x-on:add-card.window="resolve($wire.addCard($event.detail.id))">
            <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
            <svg class="w-full h-full" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 12H20M12 4V20" stroke="#ccc" stroke-width=".9" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        
    </div>
</x-section-basic>
    
<script>
    function card() {
        return {
            employees: [],

            remove(key) {
                this.employees = this.employees.filter(employee => employee !== key)
            },

            resolve(promise) {
                promise.then(data => {
                    this.employees.push(data)
                })
            },
        }
}
</script>