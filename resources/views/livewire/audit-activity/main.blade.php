 <div x-on:add-audit-activity-save-ok.window="$wire.refresh()">
    
    @php 
        if(isset($year)) 
        $active = $year->active !== 0; 
        
        else 
        $active = false;
    @endphp

    @if ($active) <livewire:audit-activity.header :$year :auditActivities="['no_poa' => $auditActivityNoPoa, 'poa' => $auditActivityPoa]"> @endif

    @push('script') @assets @vite(['resources/js/hola.js']) @endassets @endpush

    <style>
        .table-grid-audit {
            display: grid;
            grid-template-columns: 1fr 5fr repeat(3, 1fr);
            grid-column-gap: 1vw;
            grid-row-gap: 4vh;
        }
    </style>

    <x-section-basic>

        @if($active)
            @php
                $yearStatus = $year->active === $year->selected;
            @endphp
            <div role='tres' 
            class="flex
                @if($yearStatus) justify-between
                @else justify-end
                @endif w-full "
            >
                @can('auditActivity.index.newAuditActivity')
                    @if ($yearStatus) <livewire:AuditActivity.Add> @endif
                @endCan

                @can('auditActivity.index.year')
                    <livewire:AuditActivity.Year>
                @endcan
            </div>

            <div>
                <x-tabs :tabs="['Plan Operativo Anual' => 'poa', 'No Planificadas' => 'nopoa',]" default="poa">

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
                                    .tableAlpineMain-header-grid-custom {
                                        width: 100%;
                                        display: grid;
                                        grid-template-columns: 1fr 5fr 1fr 1fr 2fr;
                                        row-gap: 2rem
                                    }

                                    .tableAlpineMain-rows-alpine-grid-custom {
                                        display: grid;
                                        grid-template-columns: 1fr 5fr 1fr 1fr 2fr;

                                        /* height: 100px; */
                                    }

                                    .tableAlpineMain-cell-alpine-grid-custom {
                                        width: 100%;
                                        text-align: center;
                                    }

                                    .tableAlpineMain-Descripción-description {
                                        width: 100%;
                                        /* text-align: start; */
                                        text-align: justify!important;
                                    }

                                </style>

                                <x-table-alpine name="tableAlpineMain" :data="$auditActivities" customTable browser
                                    :nameColumns="[
                                        'Código' => 'code',
                                        'Descripción' => 'description',
                                        'Mes inicio' => 'month_start',
                                        'Mes fin' => 'month_end',
                                        'Tipo de Auditoria' => 'type_audit.name',
                                    ]"
                                    nameColumnId="public_id"
                                    eventRow="x-on:dblclick"
                                    x-on:dblclick="$wire.goTo(row.id)"
                                />

                            </div>

                        </x-slot>

                    @endforeach

                </x-tabs>
            </div>

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
                                        || auditActivity.type_audit.name.includes(query)
                                    }
                                );

                            }
                        },

                    }
                })
            </script>
            @endscript
        
        @else

            @can('auditActivity.index.year')
                <livewire:audit-activity.create-new-year> 
            @endcan

            @cannot('auditActivity.index.year')
                <h1 class="text-2xl">no puedes iniciar un año fiscal</h1>
            @endcannot

        @endif
    </x-section-basic>
</div>
