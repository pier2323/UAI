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

                    <div x-data="auditActivityMain" class="w-full">

                        <style>
                            .table-alpine-grid-custom {
                                width: 100%;
                                display: grid;
                                grid-template-columns: 1fr 5fr 1fr 1fr 2fr;
                                row-gap: 2rem
                            }

                            .rows-alpine-grid-custom {
                                display: grid;
                                grid-template-columns: 1fr 5fr 1fr 1fr 2fr;

                                /* height: 100px; */
                            }

                            .cell-alpine-grid-custom {
                                width: 100%;
                                text-align: center;
                            }

                            .Descripción-description {
                                width: 100%;
                                /* text-align: start; */
                                text-align: justify!important;
                            }

                        </style>

                        <x-table-alpine name="tableAlpineMain" :data="$auditActivities" customTable
                            :nameColumns="[
                                'Código' => 'code', 
                                'Descripción' => 'description', 
                                'Mes inicio' => 'month_start', 
                                'Mes fin' => 'month_end', 
                                'Área UAI Encargada' => 'uai.name',
                            ]"
                            nameColumnId="public_id"
                            eventRow="x-on:dblclick"
                            x-on:dblclick="$wire.goTo(row.public_id)"
                        />

                    </div>

                </x-slot>

            @endforeach

        </x-tabs>

        @script
        <script>
            Alpine.data('auditActivityMain', () => {
                return {

                    filtered(query, auditActivities, pages, currentPage) {
                        if (typeof (query !== "" ? auditActivities : pages[currentPage]) !== 'undefined') {

                            return (query !== "" ? auditActivities : pages[currentPage]).filter(
                                auditActivity => {
                                    return auditActivity.code.includes(query) 
                                    || auditActivity.description.includes(query) 
                                    || auditActivity.uai.name.includes(query)                                
                                }
                            );
                            
                        }
                    },
                    
                }
            })
        </script>
        @endscript
    </x-section-basic>
    
</div>
