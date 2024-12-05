<div>

    @php
        $th = "colspan='1' rowspan=-'1' tabindex='0'";
        $td = 'px-4 py-2';
        $headerTitle = [ 'Código' => 'code',
                                'Descripción' => 'description',
                                'Mes inicio' => 'month_start',
                                'Mes fin' => 'month_end',
                                'Área UAI Encargada' => 'uai.name',]

    @endphp
  
    {{-- @dd(json_encode($designations)) --}}

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

    <div x-data="handover">

        <x-section-basic>

            <x-table-alpine name="tableHandover" :data="$auditActivity" customTable
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
            
        </x-section-basic>

    </div>


    @script
    <script>
        Alpine.data('handover', () => {
            return {
                filtered(query, auditActivities, pages, currentPage) {
                        if (typeof (query !== "" ? auditActivities : pages[currentPage]) !== 'undefined') {

                            return (query !== "" ? auditActivities : pages[currentPage]).filter(
                                auditActivity => {
                                    console.log(auditActivity.description.includes(query))
                                    return true
                                    // auditActivity.code.includes(query)
                                    // auditActivity.description.includes(query)
                                    // || auditActivity.uai.name.includes(query)
                                }
                            );

                        }
                    },
            }
        })
    </script>
    @endscript

</div>

