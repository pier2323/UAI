<x-app-layout>



    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-4 py-2">
                    <section
                        class="container mx-auto flex flex-col items-center justify-center px-8 py-3 align-middle sm:flex-row-reverse sm:px-12">
                        <div style="overflow:hidden ; border: 1px solid #525252; border-radius: 20px"
                            class="border-slate-500">
                            <img alt="foto de perfil" style="width: 15vw"
                                src="{{ URL::asset("storage/$employee->profile_photo") }}" />
                        </div>
                        <div class="border- mr-4 w-full text-center sm:w-1/2 sm:text-left">
                            <ul class="mb-8 flex flex-col items-center space-y-1 dark:text-slate-400 sm:items-start">
                                <li class="flex items-end">
                                    <h2 class="mt-4 text-2xl font-semibold">
                                        {{ "$employee->first_name $employee->second_name $employee->first_surname $employee->second_surname" }}
                                    </h2>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Cargo: {{ $employee->jobTitle->name }}</p>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">P00: {{ "$employee->p00" }}</p>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Cedula: {{ "$employee->personal_id" }}</p>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Teléfono: +58{{ "$employee->phone" }}</p>
                                </li>
                                <li class="flex items-end">
                                <li class="text-gray-600">Correo electrónico: {{ "$employee->gmail" }}</li>
                                </li>
                                <li class="flex items-end">
                                <li class="text-gray-600">Correo Institucional: {{ "$employee->email_cantv" }}</li>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Area UAI: {{ $employee->uai->name }}</p>
                                </li>
                            </ul>


                            {{-- botones para la edicion y eliminación --}}
                            <div class="flex flex-col space-y-3 md:flex-row md:space-x-2 md:space-y-0">
                                <a href="{{ route('employee.edit', $employee->id) }}">
                                    <button
                                        class="rounded-lg border-0 bg-slate-900 px-6 py-3 text-base text-white shadow-lg shadow-slate-600 transition hover:bg-blue-600 hover:text-slate-900 hover:shadow-blue-600 dark:bg-blue-600 dark:text-black dark:shadow-sm dark:shadow-blue-600 dark:hover:bg-blue-400 sm:py-2">
                                        Editar
                                    </button>
                                </a>
                                <a>
                                    <button id="action1"
                                        class=" rounded-lg border-0 btn btn-danger px-6 py-3 text-base text-white shadow-lg ">
                                        Eliminar
                                    </button>
                                </a>
                            </div>
                             {{--   fin botones para la edicion y eliminación --}}


                            <div class="modal fade" id="confirm_modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered rounded-0">
                                    <div class="modal-content rounded-0">
                                        <div class="modal-header py-1">
                                            <h5 class="modal-title">Eliminar</h5>
                                        </div>
                                        <div class="modal-body">
                                        </div>

                                        <div class="modal-footer py-1">
                                            <form action="{{ route('employee.delete', $employee->id) }}"
                                                method="GET">
                                                <button type="submit"
                                               class="rounded-lg border-0 btn btn-danger 0 py-1 text-base text-white shadow-lg ">
                                                    Eliminar 
                                                </button>

                                            </form>

                                            <button type="button" class="rounded-lg border-0 btn btn-primary 0 py-1 text-base text-white shadow-lg"
                                                data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="action_display" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered rounded-0">
                                    <div class="modal-content rounded-0">
                                        <div class="modal-header py-1">
                                            <h5 class="modal-title">Action Result</h5>
                                        </div>
                                        <div class="modal-body">
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 py-1"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </section>

            </div>
        </div>
    </div>
    </div>

    @php
        $full = "$employee->first_name  $employee->second_name $employee->first_surname $employee->second_surname .";

    @endphp


    <script>
        function action1() {
            var result = "se borro";
            var action_display = $('#action_display')

            action_display.find('.modal-body').html(result)
            action_display.modal('show')
        }

        function action2() {
            var result = "Action 2 has been clicked";
            var action_display = $('#action_display')
            action_display.find('.modal-body').html(result)
            action_display.modal('show')
        }




        window._confirm = function($message = '', $func = '', $param = []) {
            if ($func != '' && typeof window[$func] == 'function') {

                var modal_el = $('#confirm_modal')
                modal_el.find('.modal-body').html($message)
                modal_el.modal('show')
                modal_el.find('#confirm-btn').click(function(e) {
                    e.preventDefault()
                    if ($param.length > 0 && !!$.isArray($param))
                        window[$func].apply(this, $param)
                    else
                        window[$func]($param)
                    modal_el.modal('hide')
                })
            } else {
                alert("Function does not exists.")
            }
        }
        $(function() {
            $("#action1").click(function() {
                fullname = "{{ $full }}"
                fullname = fullname.toLowerCase()
                fullname = fullname.slice(0, -1)

                _confirm(`¿Seguro que quieres eliminar a <br> ${fullname}?`, 'action1')
            })

        })
    </script>




</x-app-layout>
