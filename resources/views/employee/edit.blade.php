@php
    $inputClass =
        "mb-6 border'2 border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500";
    $liClass = 'flex flex-column justify-start items-start';
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-4 py-2">
                    <section
                        class="container mx-auto flex flex-col items-center justify-center px-8 py-3 align-middle sm:flex-row-reverse sm:px-12">
                        <div style="overflow:hidden ; border: 1px solid #777; border-radius: px; margin-bottom: 500px;"
                            class="border-slate-500">
                            <img alt="foto de perfil" style="width: 15vw" src="{{ "$employee->profile_photo" }}" />
                        </div>
                        <div class="border- mr-4 w-full text-center sm:w-1/2 sm:text-left">
                            <ul class="mb-8 flex flex-col items-center space-y-1 dark:text-slate-400 sm:items-start">
                                <li class="flex items-end">
                                    <h2 class="mt-4 text-2xl font-semibold">
                                        {{ "$employee->first_name $employee->second_name $employee->first_surname $employee->second_surname" }}
                                    </h2>
                                </li>

                                <form class="{{ $liClass }}"
                                    action="{{ route('employee.update', $employee->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <label for="job_title" class="col-form-label">Cargo:</label>
                                    <select id="job_title" name="job_title" type="text"
                                        class="{{ $inputClass }}"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                        @foreach ($jobTitle as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->name }}</option>
                                        @endforeach
                                    </select>
                                    <li class="{{ $liClass }}">
                                        <div>

                                        </div>
                                        <label for="p00" class="col-form-label">P00:</label>
                                        <input id="p00" name="p00" type="text"
                                            class="{{ $inputClass }}" value="{{ $employee->p00 }}" />
                                    </li>
                                    <li class="{{ $liClass }}">
                                        <label for="personal_id" class="col-form-label">Cedula:</label>
                                        <input id="personal_id" name="personal_id" type="text"
                                            class="{{ $inputClass }}" value="{{ $employee->personal_id }}" />
                                    </li>
                                    <li class="{{ $liClass }}">
                                        <label for="phone" class="col-form-label">Telefono:</label>
                                        <input id="phone" name="phone" type="text"
                                            class="{{ $inputClass }}" value="{{ $employee->phone }}" />
                                    </li>
                                    <li class="{{ $liClass }}">
                                        <label for="gmail" class="col-form-label">Correo
                                            electrónico:</label>
                                        <input id="gmail" name="gmail" type="text"
                                            class="{{ $inputClass }}" value="{{ $employee->gmail }}" />
                                    </li>
                                    <li class="{{ $liClass }}">
                                        <label for="email_cantv" class="col-form-label">Correo
                                            Institucional:</label>
                                        <input id="email_cantv" name="email_cantv" type="text"
                                            class="{{ $inputClass }}" value="{{ $employee->email_cantv }}" />
                                    </li>
                                    <label for="uai" class="col-form-label">Area UAI:</label>

                                    <select id="uai" name="uai" class="{{ $inputClass }}"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">

                                        @foreach ($uai as $departament)
                                            <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                                        @endforeach
                                    </select>
                            </ul>
                            <div class="flex flex-col space-y-3 md:flex-row md:space-x-2 md:space-y-0">
                                <button type="submit"
                                    class="rounded-lg border-0 bg-slate-900 px-6 py-3 text-base text-white shadow-lg shadow-slate-600 transition hover:bg-blue-600 hover:text-slate-900 hover:shadow-blue-600 dark:bg-blue-600 dark:text-black dark:shadow-sm dark:shadow-blue-600 dark:hover:bg-blue-400 sm:py-2">Guardar</button>

                                <a href="{{ route('employee.index') }}">
                                    <button type="button"
                                        class="rounded-lg border-0 bg-white px-6 py-3 text-base text-slate-900 shadow-lg shadow-slate-100 transition hover:bg-blue-300 hover:text-slate-900 hover:shadow-blue-600 dark:bg-slate-700 dark:text-slate-300 dark:shadow-sm dark:shadow-slate-800 dark:hover:bg-slate-600 sm:py-2">Atras</button>
                                </a>
                            </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
