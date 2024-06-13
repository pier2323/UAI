<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-section-basic class="pb-5">
        <div class="m-16">
            @livewire('employee.registerForm')
        </div>
        <x-table>
            <x-slot name="head">
                <thead>
                    <tr>
                        <th {{-- style="width: 50px" --}} aria-controls="datatable_users"
                            aria-label="#: activate to sort column ascending" aria-sort="descending"
                            class="code centered sorting sorting_desc px-4 py-2" colspan="1" rowspan="1"
                            tabindex="0">
                            P00
                        </th>
                        <th aria-controls="datatable_users" aria-label="Name: activate to sort column ascending"
                            class="centered sorting px-4 py-2" colspan="1" rowspan="1" style="width: 189px"
                            tabindex="0">
                            Nombre
                        </th>
                        <th aria-controls="datatable_users" aria-label="Company: activate to sort column ascending"
                            class="centered sorting px-4 py-2" colspan="1" rowspan="1" style="width: 166px"
                            tabindex="0">
                            Correo institucional
                        </th>
                        <th aria-label="Status" class="centered sorting_disabled px-4 py-2" colspan="1"
                            rowspan="1" style="width: 60px">
                            Cédula

                        </th>
                        <th aria-label="Status" class="centered sorting_disabled px-4 py-2" colspan="1"
                            rowspan="1" style="width: 60px"> Télefono
                        </th>
                        </th>
                        <th aria-label="Detalles " class="centered sorting_disabled px-4 py-2" colspan="1"
                            rowspan="1" style="width: 60px"> Detalles
                        </th>
                    </tr>
                </thead>
            </x-slot>
            @foreach ($employees as $employee)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2"> {{ $employee->p00 }}</td>
                    <td class="px-4 py-2">
                        {{ $employee->first_name . ' ' . $employee->first_surname . ' ' . $employee->second_surname }}
                    </td>
                    <td class="px-4 py-2">{{ $employee->email_cantv }}</td>
                    <td class="px-4 py-2">{{ $employee->persona_id }}</td>
                    <td class="px-4 py-2">{{ $employee->phone }}</td>
                    <td class="px-4 py-2"><a href="{{ route('employee.show', $employee->id) }}"><img height="30"
                                src="/images/template/ojo.png" width="30"></a></td>
                </tr>
            @endforeach
        </x-table>
    </x-section-basic>
</x-app-layout>
