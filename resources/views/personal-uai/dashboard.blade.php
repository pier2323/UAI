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
                <div class="px-4 py-2"> 

                    <x-table>
                        <x-slot name="head">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 code centered sorting sorting_desc" tabindex="0"
                                    aria-controls="datatable_users" rowspan="1" colspan="1" {{-- style="width: 50px" --}}
                                    aria-label="#: activate to sort column ascending" aria-sort="descending">
                                    P00
                                </th>
                                <th class="px-4 py-2 centered sorting" tabindex="0" aria-controls="datatable_users"
                                rowspan="1" colspan="1" style="width: 189px"
                                aria-label="Name: activate to sort column ascending">
                                Nombre
                            </th>
                            <th class="px-4 py-2 centered sorting" tabindex="0" aria-controls="datatable_users"
                            rowspan="1" colspan="1" style="width: 166px"
                            aria-label="Company: activate to sort column ascending">
                            Correo institucional
                        </th>
                        <th class="px-4 py-2 centered sorting_disabled" rowspan="1" colspan="1" style="width: 60px"
                        aria-label="Status">
                        Cédula
                    </th>
                    <th class="px-4 py-2 centered sorting_disabled" rowspan="1" colspan="1" style="width: 60px"
                    aria-label="Status"> Télefono
                </tr>
            </thead>
        </x-slot>
        @foreach ($data as $personalUai)
        <tr class="hover:bg-gray-100">
            <td class="px-4 py-2"> {{ $personalUai['p00'] }}</td>
            <td  class="px-4 py-2">
                {{ 
                                    $personalUai['primer_nombre']." ".
                                    $personalUai['primer_apellido']." ".
                                    $personalUai['segundo_apellido']
                                }}
                            </td>
                            <td  class="px-4 py-2">{{ $personalUai['email_cantv'] }}</td>
                            <td  class="px-4 py-2">{{ $personalUai['cedula'] }}</td>
                            <td  class="px-4 py-2">{{ $personalUai['telefono'] }}</td>
                        </tr>
                        @endforeach
                    </x-table>
                </div>
                </div>
            </div>
        </div>
        <x-input />
    </x-app-layout>
    