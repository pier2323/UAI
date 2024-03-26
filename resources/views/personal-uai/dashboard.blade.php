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
                <x-table>
                    <x-slot name="head">
                        <thead>
                            <tr>
                                <th class="code centered sorting sorting_desc" tabindex="0"
                                    aria-controls="datatable_users" rowspan="1" colspan="1" {{-- style="width: 50px" --}}
                                    aria-label="#: activate to sort column ascending" aria-sort="descending">
                                    P00
                                </th>
                                <th class="centered sorting" tabindex="0" aria-controls="datatable_users"
                                    rowspan="1" colspan="1" style="width: 189px"
                                    aria-label="Name: activate to sort column ascending">
                                    nombre
                                </th>
                                <th class="centered sorting" tabindex="0" aria-controls="datatable_users"
                                    rowspan="1" colspan="1" style="width: 166px"
                                    aria-label="Company: activate to sort column ascending">
                                    correo institucional
                                </th>
                                <th class="centered sorting_disabled" rowspan="1" colspan="1" style="width: 60px"
                                    aria-label="Status">
                                    cedula
                                </th>
                                <th class="centered sorting_disabled" rowspan="1" colspan="1" style="width: 60px"
                                    aria-label="Status"> telefono
                            </tr>
                        </thead>
                    </x-slot>
                    @foreach ($data as $personalUai)
                        <tr>
                            <td>{{ $personalUai['p00'] }}</td>
                            <td>
                                {{ 
                                    $personalUai['primer_nombre']." ".
                                    $personalUai['primer_apellido']." ".
                                    $personalUai['segundo_apellido']
                                }}
                            </td>
                            <td>{{ $personalUai['email_cantv'] }}</td>
                            <td>{{ $personalUai['cedula'] }}</td>
                            <td>{{ $personalUai['telefono'] }}</td>
                        </tr>
                    @endforeach
                </x-table>
            </div>
        </div>
    </div>
    <x-input />
</x-app-layout>
