 <div>
    @push('script') @assets  @vite(['resources/js/hola.js']) @endassets @endpush

    <style>
        .table-grid-audit {
            display: grid;
            grid-template-columns: 1fr 5fr repeat(3, 1fr);
            grid-column-gap: 1vw;
            grid-row-gap: 4vh;
        }
    </style>

    <x-section-basic>
        <div>
            <livewire:AuditActivity.Add>
        </div>

        <x-tabs :tabs="['Plan Operativo Anual' => 'poa', 'No Planificadas' => 'nopoa']" default="poa">

            @foreach ([
                'poa' => $auditActivityPoa, 
                'nopoa' => $auditActivityNoPoa,
            ] as $type => $auditActivities)

            @foreach ($auditActivities as $auditActivity)
            @php
                $auditActivity->code = $auditActivity->code
            @endphp
            @endforeach
                
                <x-slot :name="$type">

                    <div class="p-3">
                        
                        <div class="flex justify-between pr-10">

                            {{-- todo browser --}}
                            <x-input class="ml-6" type="search" x-model="$wire.query" placeholder='Buscar...' />

                            <h3 role="table-title" class="text-2xl font-semibold">

                                @if($type == 'poa') Plan Operativo Anual
                                @else No Planificadas
                                @endif
                            
                            </h3>
                        </div>
                
               
                        <ul x-data="auditActivityMain" x-init="start(@js($auditActivities))" class="justify-center mt-4 table-grid-audit">
                
                            {{-- todo head --}}
                            @foreach (['Código ', 'Descripcion', 'Mes inicio', 'Mes fin', 'Area UAI Encargada',] as $row)
                                <li class="text-center border-b border-b-slate-300"> {{ $row }} </li>
                            @endforeach
                            
                            {{-- todo body --}}
                            <template x-for="auditActivity in filtered" :key="auditActivity.public_id">
                                
                                <li style="grid-column: span 5" class="cursor-pointer select-none hover:bg-gray-100 active:bg-gray-300" 
                                x-on:click="$wire.goTo(auditActivity.public_id)">

                                    <button class="items-center table-grid-audit">
                                        <div x-text="auditActivity.code"></div> 
                                        <div class="text-start" x-text="auditActivity.description"></div> 
                                        <div x-text="auditActivity.month_start"></div> 
                                        <div x-text="auditActivity.month_end"></div>
                                        <div x-text="auditActivity.uai.name"></div>
                                    </button>

                                </li>
                                
                            </template>
                            
                        </ul>

                    </div>
                    
                </x-slot>

            @endforeach

        </x-tabs>

        @script
        <script>
            Alpine.data('auditActivityMain', () => {
                return {
                    auditActivities: {},

                    start(data) {
                        this.auditActivities = data; 
                    },

                    get filtered() {
                        return this.auditActivities.filter(
                            auditActivity => {
                                return auditActivity.code.includes($wire.query) 
                                || auditActivity.description.includes($wire.query) 
                                || auditActivity.uai.name.includes($wire.query)                                
                            }
                        );
                    },
                }
            })
        </script>
        @endscript
    </x-section-basic>
    
</div>
