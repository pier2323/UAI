<div>

    @php
        $th = "colspan='1' rowspan=-'1' tabindex='0'";
        $td = 'px-4 py-2';

        
    @endphp




    <style>
        .tableHandover-header-grid-custom {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 5fr 1fr 1fr 2fr;
            row-gap: 2rem
        }

        .tableHandover-rows-alpine-grid-custom {
            display: grid;
            grid-template-columns: 1fr 5fr 1fr 1fr 2fr;

            /* height: 100px; */
        }

        .tableHandover-cell-alpine-grid-custom {
            width: 100%;
            text-align: center;
        }

        .tableHandover-Descripción-description {
            width: 100%;
            /* text-align: start; */
            text-align: justify !important;
        }
    </style>

    <div x-data="handover">

        <x-section-basic>

            @foreach ($auditActivity as $audit)
                @php
                $audit->code = $audit->code;
                /*** // modificado por geferson
                 * codigo anterior
                 * $audit->uai->name = $audit->uai->name;
                 * en este caso el poa 2025 no estuvo asignado a las coordinaciones (variable $audit->uai)
                 * este campo saldrá vacio, si se usa directamente da error porque esta en null
                 * para que funcione, y asi en las columnas que tengan las mismas condiciones de que pueden ser null
                 * hay que consultar si existe el campo con el if y la funcion isset()
                */
                if (isset($audit->uai)) {
                    $audit->uai->name = $audit->uai->name;
                }
                @endphp   
            @endforeach

              


            <x-table-alpine name="tableHandover" :data="$auditActivity" browser customTable :nameColumns="[
                'Código' => ' code',
                'Descripción' => 'description',
                'Mes inicio' => 'month_start',
                'Mes fin' => 'month_end',
                'Área UAI Encargada' => isset($audit->uai) ? 'uai.name' : 'null', 
            ]" nameColumnId="id"
                eventRow="x-on:dblclick" x-on:dblclick="$wire.goTo(row.id)" />

        </x-section-basic>

    </div>


    @script
        <script>
            Alpine.data('handover', () => {
                return {
                    filtered(query, auditActivities, pages, currentPage) {
                        if (typeof(query !== "" ? auditActivities : pages[currentPage]) !== 'undefined') {

                            return (query !== "" ? auditActivities : pages[currentPage]).filter(
                                function (auditActivity) {
                                    return auditActivity.description.includes(query) 
                                    ||auditActivity.code.includes(query)
                                }
                            );

                        }
                    },
                }
            })
        </script>
    @endscript

</div>
