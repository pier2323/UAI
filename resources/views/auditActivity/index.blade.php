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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                    <div class="dataTables_wrapper dt-bootstrap5 no-footer"
                                        id="datatable_users_wrapper">
                                        <div class="col-sm-12">
                                            @livewire('auditActivity.registerForm')
                                        </div>
                                    </div>
                                </div>
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
                                </tr>
                            </thead>
                        </x-slot>
                        @foreach ($auditActivities as $auditActivity)
                            <tr {{-- @click="window.location.href = link" --}} class="hover:bg-gray-100" x-data="{ link: '{{ route('auditActivity.index') }}', }">
                                <td class="px-4 py-2">{{ $auditActivity->id }}</td>
                                <td class="px-4 py-2">{{ $auditActivity->objective }}</td>
                            </tr>
                        @endforeach
                    </x-table>
                    {{--    <livewire:counter /> --}}
                </div>
            </div>
        </div>
    </div>
    


	  
	  

   
    {{--    <div x-data="main()">

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
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <button class="btn btn-primary" data-bs-target="#exampleModal"
                                        data-bs-toggle="modal" data-bs-whatever="@mdo" type="button">
                                        Nueva Acta
                                    </button>
                                    <div class="dataTables_wrapper dt-bootstrap5 no-footer"
                                        id="datatable_users_wrapper">
                                        <div class="col-sm-12">
                                            @include('modal')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-table>
                        <x-slot name="head">
                            <thead>
                                <tr>
                                    <th {{-- style="width: 50px"
									aria-controls="datatable_users"
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
                        @foreach ($data as $acta)
                            <tr {{-- @click="window.location.href = link"class="hover:bg-gray-100" x-data="{ link: '{{ route('action.show', $acta->id) }}', }">
                                <td @click="console.log('hola')" class="px-4 py-2">{{ $acta->id }}</td>
                                <td class="px-4 py-2">{{ $acta->actuacionFiscal->objetivo }}</td>
                                <td class="px-4 py-2">{{ $acta->actuacionFiscal->inicio }}</td>
                                <td class="px-4 py-2">{{ $acta->actuacionFiscal->fin }}</td>
                                <td class="px-4 py-2">{{ $acta->personalEntrega->unidad->nombre }}</td>
                                <td class="px-4 py-2">
                                <td class="px-4 py-2"><a href="{{ route('detalles') }}"><img
                                            src="/images/template/ojo.png" width="30" height="30"></a></td>
                            </tr>
                            <td class="px-4 py-2">
                                </tr>
                        @endforeach
                    </x-table>
                    {{--    <livewire:counter /> 
                </div>
            </div>
        </div>
    </div>
    {{--    <div x-data="main()">
		>>>>>>> 20db08da (actualizacion de paginas  y crecion de controladores):resources/views/action/index.blade.php
		--}}
    {{-- <button @click="incrementar">Incrementar</button>
    <span x-text="contador"></span>
</div>

<script>
    function main() {
        return 
        {
            contador: 15,
            incrementar: function() {
                return this.contador++
            }
        }
    }
</script> --}}
</x-app-layout>
