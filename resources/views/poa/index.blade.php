<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12" style=" padding-bottom: 130px">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-4 py-2">
                    <div class="bg-gray-10 grid grid-cols-1 gap-6 bg-opacity-10 p-6 md:grid-cols-2 lg:gap-8 lg:p-8">
                        <div class="container my-4 bg-white">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                    <x-table>
                        <x-slot name="head">
                            <thead>
                                <tr>
                                    <th {{-- style="width: 50px" --}} aria-controls="datatable_users"
                                        aria-label="#: activate to sort column ascending" aria-sort="descending"
                                        class="code centered sorting sorting_desc px-4 py-2" colspan="1"
                                        rowspan="1" tabindex="0">
                                        código
                                    </th>
                                    <th aria-controls="datatable_users"
                                        aria-label="Name: activate to sort column ascending"
                                        class="centered sorting px-4 py-2" colspan="1" rowspan="1"
                                        style="width: 189px" tabindex="0">
                                        Descrición de la Actuacion
                                    </th>
                                    <th aria-controls="datatable_users"
                                    aria-label="Company: activate to sort column ascending"
                                    class="centered sorting px-4 py-2" colspan="1" rowspan="1"
                                    style="width: 166px" tabindex="0">
                                    Fecha de recepción                                </th>
                                    <th aria-controls="datatable_users"
                                        aria-label="Company: activate to sort column ascending"
                                        class="centered sorting px-4 py-2" colspan="1" rowspan="1"
                                        style="width: 166px" tabindex="0">
                                        Fecha inicio
                                    </th>
                                    <th aria-label="Status" class="centered sorting_disabled px-4 py-2" colspan="1"
                                        rowspan="1" style="width: 60px">
                                        Fecha fin
                                    </th>
                                    <th aria-label="Status" class="centered sorting_disabled px-4 py-2" colspan="1"
                                        rowspan="1" style="width: 60px"> Area UAI
                                    </th>
                                    <th aria-label="Status" class="centered sorting_disabled px-4 py-2" colspan="1"
                                        rowspan="1" style="width: 60px"> status
                                    </th>
                                    <th aria-label="Status" class="centered sorting_disabled px-4 py-2" colspan="1"
                                        rowspan="1" style="width: 60px">Detalles
                                    </th>
                                </tr>
                            </thead>
                        </x-slot>                        
                        <tr >
                            <td class="px-4 py-2"> hola  </td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"><a href="{{ route('detalles') }}"><img
                                        src="/images/template/ojo.png" width="30" height="30"></a></td>
                        </tr>
                    </x-table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
