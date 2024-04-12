<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-2">
                    <section
                        class="container mx-auto flex flex-col items-center px-8 py-36 sm:flex-row-reverse sm:px-12">
                        <div class="mb-8 w-full sm:mb-0 sm:w-1/2 sm:pl-4 md:pl-16">
                            <img alt="foto de perfil" class="rounded-lg sm:rounded-br-[80px] sm:rounded-tl-[120px]"
                                src="{{ "$personal->foto_perfil" }}" />
                        </div>
                        <div class="mr-4 w-full text-center sm:w-1/2 sm:text-left">

                            <ul class="mb-8 flex flex-col items-center space-y-1 dark:text-slate-400 sm:items-start">
                                <li class="flex items-end">
                                    <h2 class="text-2xl font-semibold mt-4">
                                        {{ "$personal->primer_nombre $personal->segundo_nombre $personal->primer_apellido $personal->segundo_apellido" }}
                                    </h2>
                                    <p>{{ $personal->cargo->nombre }}</p>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">P00: {{ "$personal->p00" }}</p>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Cedula: {{ "$personal->cedula" }}</p>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Teléfono: +58{{ "$personal->telefono" }}</p>
                                </li>
                                <li class="flex items-end">
                                <li class="text-gray-600">Correo electrónico: {{ "$personal->gmail" }}</li>
                                </li>
                                <li class="flex items-end">
                                <li class="text-gray-600">Correo Institucional: {{ "$personal->email_cantv" }}</li>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Area UAI: {{ $personal->uai->nombre }}</p>
                                </li>
                            </ul>
                            <div class="flex flex-col space-y-3 md:flex-row md:space-x-2 md:space-y-0">
                                <button
                                    class="rounded-lg border-0 bg-slate-900 px-6 py-3 text-base text-white shadow-lg shadow-slate-300 transition hover:bg-orange-300 hover:text-slate-900 hover:shadow-orange-300 dark:bg-orange-300 dark:text-black dark:shadow-sm dark:shadow-orange-300 dark:hover:bg-orange-400 sm:py-2">
                                    Open menu
                                </button>
                                <button
                                    class="rounded-lg border-0 bg-white px-6 py-3 text-base text-slate-900 shadow-lg shadow-slate-100 transition hover:bg-orange-300 hover:text-slate-900 hover:shadow-orange-300 dark:bg-slate-700 dark:text-slate-300 dark:shadow-sm dark:shadow-slate-800 dark:hover:bg-slate-600 sm:py-2">
                                    Explore services
                                </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
