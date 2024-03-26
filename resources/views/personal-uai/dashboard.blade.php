<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />

                @php
                    $data = [
                        [
                            'codigo' => 'ACT-001',
                            'descripcion_actuacion' => 'Mantenimiento preventivo de servidores',
                            'fecha_inicio' => '2024-03-25',
                            'fecha_fin' => '2024-03-27',
                            'area_uai' => 'Infraestructura TI',
                        ],
                        [
                            'codigo' => 'ACT-002',
                            'descripcion_actuacion' => 'Migración de datos a la nueva infraestructura',
                            'fecha_inicio' => '2024-04-01',
                            'fecha_fin' => '2024-04-10',
                            'area_uai' => 'Desarrollo de Software',
                        ],
                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],                        [
                            'codigo' => 'ACT-003',
                            'descripcion_actuacion' => 'Capacitación al personal en nuevas tecnologías',
                            'fecha_inicio' => '2024-05-05',
                            'fecha_fin' => '2024-05-07',
                            'area_uai' => 'Recursos Humanos',
                        ],
                    ];

                @endphp
                <x-table>
                    <x-slot name="head">
                        <thead>
                            <tr>
                                <th class="code centered sorting sorting_desc" tabindex="0"
                                    aria-controls="datatable_users" rowspan="1" colspan="1" {{-- style="width: 50px" --}}
                                    aria-label="#: activate to sort column ascending" aria-sort="descending">
                                    código
                                </th>
                                <th class="centered sorting" tabindex="0" aria-controls="datatable_users"
                                    rowspan="1" colspan="1" style="width: 189px"
                                    aria-label="Name: activate to sort column ascending">
                                    Descrición de la Actuacion
                                </th>
                                <th class="centered sorting" tabindex="0" aria-controls="datatable_users"
                                    rowspan="1" colspan="1" style="width: 166px"
                                    aria-label="Company: activate to sort column ascending">
                                    Fecha inicio
                                </th>
                                <th class="centered sorting_disabled" rowspan="1" colspan="1" style="width: 60px"
                                    aria-label="Status">
                                    Fecha fin
                                </th>
                                <th class="centered sorting_disabled" rowspan="1" colspan="1" style="width: 60px"
                                    aria-label="Status"> Area UAI
                            </tr>
                        </thead>
                    </x-slot>
                    @foreach ($data as $actuacion)
                        <tr>
                            <td>{{ $actuacion['codigo'] }}</td>
                            <td>{{ $actuacion['descripcion_actuacion'] }}</td>
                            <td>{{ $actuacion['fecha_inicio'] }}</td>
                            <td>{{ $actuacion['fecha_fin'] }}</td>
                            <td>{{ $actuacion['area_uai'] }}</td>
                        </tr>
                    @endforeach
                </x-table>
            </div>
        </div>
    </div>
    <x-input />
</x-app-layout>
