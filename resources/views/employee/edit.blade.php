@php
    $inputClass =
        'mb-5 mt-2 flex h-10 w-full items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';
    $liClass = 'flex flex-column justify-start items-start';
@endphp


@php
    $phone_code = substr($employee->phone, 0, 4);
    $phone_number = substr($employee->phone, 4, 7);
    $codes = ['0412', '0414', '0416', '0424', '0426', '0212'];
@endphp


<script defer src="/js/employee/registerFormScript/changeImage.js"></script>
<script src="/js/employee/registerFormScript/alpine.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- ! inicializador de las variables  --}}
    <div x-data="form" x-init="firstName = '{{ $employee->first_name }}'
    secondName = '{{ $employee->second_name }}'
    firstSurname = '{{ $employee->first_surname }}'
    secondSurname = '{{ $employee->second_surname }}'
    phone = '{{ $phone_number }}';
    p00 = '{{ $employee->p00 }}';" {{-- ! fin  de las variables  --}} class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-4 py-2">
                    <section
                        class="container mx-auto flex flex-col items-center justify-center px-8 py-3 align-middle sm:flex-row-reverse sm:px-12">
                        <div style="overflow:hidden ; border: 1px solid #777; border-radius: px; margin-bottom: 800px;"
                            class="border-slate-500">
                            <img alt="foto de perfil" style="width: 15vw"
                                src="{{ asset("storage/$employee->profile_photo") }}" />
                        </div>
                        <div class="border- mr-4 w-full text-center sm:w-1/2 sm:text-left">
                            <ul class="mb-8 flex flex-col items-center space-y-1 dark:text-slate-400 sm:items-start">
                                <li class="flex items-end">
                                    <h2 class="mt-4 text-2xl font-semibold">
                                        {{ "$employee->first_name $employee->second_name $employee->first_surname $employee->second_surname" }}
                                    </h2>
                                </li>
                                <form class="{{ $liClass }}"
                                    action="{{ route('employee.update', $employee->id) }}"
                                    enctype="multipart/form-data" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="image">

                                        <div id="zona-carga">
                                            <img id="zona-carga-img"
                                                src="{{ asset("storage/$employee->profile_photo") }}" />
                                        </div>
                                        <label for="photo">click para subir una imagen</label>
                                        <input accept="image/*" class="btn btn-primary mb-3" id="photo"
                                            name="photo" type="file">
                                    </div>



                                    <div class="mb-3">
                                        @error('first_name')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror

                                        <div class="bg mb-3">
                                            <label class="{{ $liClass }}" for="recipient-firstName">Primer
                                                Nombre:</label>
                                            <input class="{{ $inputClass }}" id="recipient-firstName"
                                                name="first_name" data-attribute-name="Primer Nombre"type="text"
                                                x-model="firstName" x-on:input="firstName = transformedInput(firstName)"
                                                value="{{ $employee->first_name }}">
                                        </div>
                                    </div>
                                    @error('second_name')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror

                                    <div class="mb-3">
                                        <label class="{{ $liClass }}" for="recipient-secondName">Segundo
                                            Nombre:</label>
                                        <input class="{{ $inputClass }}" id="recipient-secondName" name="second_name"
                                            type="text" x-model="secondName"
                                            x-on:input="secondName = transformedInput(secondName)"
                                            value="{{ $employee->second_name }}" />
                                    </div>


                                    @error('first_surname')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror

                                    <div class="mb-3">
                                        <label class="{{ $liClass }}" for="recipient-firstSurname">Primer
                                            Apellido:</label>
                                        <input class="{{ $inputClass }}" id="recipient-firstSurname"
                                            name="first_surname" type="text" x-model="firstSurname"
                                            x-on:input="firstSurname = transformedInput(firstSurname)"
                                            value="{{ $employee->first_surname }}" />
                                    </div>

                                    <div class="mb-3">

                                        @error('second_surname')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror

                                        <label class="{{ $liClass }}" for="recipient-secondSurname">Segundo
                                            Apellido:</label>
                                        <input class="{{ $inputClass }}" id="recipient-secondSurname"
                                            name="second_surname" type="text"
                                            x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''"
                                            x-bind:disabled="markedSecondSurname" x-bind:required="markedSecondSurname"
                                            x-model="secondSurname"
                                            x-on:input="secondSurname = transformedInput(secondSurname)"
                                            value="{{ $employee->first_surname }}" />
                                    </div>

                                    <div class="mb-3">
                                        @error('email_cantv')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                        <label class="{{ $liClass }}" for="recipient-email_cantv">Correo
                                            Institucional:</label>
                                        <input class="{{ $inputClass }}" id="recipient-email_cantv"
                                            name="email_cantv" wire:model="email_cantv" type="email"
                                            value="{{ $employee->email_cantv }}">
                                    </div>

                                    @error('gmail')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                    <li class="{{ $liClass }}">
                                        <label for="gmail" class="col-form-label">Correo
                                            Eletronico:</label>
                                        <input id="gmail" name="gmail" type="text" class="{{ $inputClass }}"
                                            wire:model="gmail" value="{{ $employee->gmail }}" />
                                    </li>



                                    <div class="mb-3">
                                        @error('phone')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror

                                        <div class="mb-3">
                                            <label class="{{ $liClass }}" for="phoner">Teléfono:</label>
                                            <div class="flex">
                                                <select
                                                    class="flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                                    name="phone_code" id="phone_code" style="margin-top: 10px;">

                                                    @foreach ($codes as $code)
                                                        <option @if ($code === $phone_code) selected @endif
                                                            value="{{ $code }}">
                                                            {{ $code }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <p class="font-extrabold block p-2" style="margin-top: 10px">-</p>

                                                <input id="phoneNumber" class="{{ $inputClass }}"
                                                    name="phone_number" type="tel" value=""
                                                    x-model="phone" x-on:input="phone=updatephone(phone)"
                                                    id="phone">

                                            </div>
                                        </div>
                                    </div>



                                    <label for="uai" class="col-form-label" style="margin-right: 300px;">Area
                                        UAI:</label>

                                    <select id="uai" name="uai" class="{{ $inputClass }}"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">

                                        @foreach ($uai as $departament)
                                            <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="job_title" class="col-form-label"
                                        style="margin-right: 300px;">Cargo:</label>
                                    <select id="job_title" name="job_title" type="text"
                                        class="{{ $inputClass }}"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                        @foreach ($jobTitle as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->name }}</option>
                                        @endforeach
                                    </select>
                            </ul>
                            <div class="flex flex-col space-y-3 md:flex-row md:space-x-2 md:space-y-0">
                                <x-button type="submit">Guardar</x-button>

                                <a href="{{ route('employee.index') }}">
                                    <x-secondary-button wire:click="resetComponent" style="margin-right: 10px;"
                                        id="cancelar">cancelar</x-secondary-button>
                                </a>

                            </div>
                    </section>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
