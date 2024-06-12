<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8" style="padding-left: 14rem;padding-right: 14rem;">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-4 py-2">
                    <section>
                        <div class="border- mr-4 w-full text-center sm:w-1/2 sm:text-left">
                            <ul class="mb-8 flex flex-col items-center space-y-1 dark:text-slate-400 sm:items-start"style="margin-left: 40px;">
                                <li class="flex items-end">
                                    <h2 class="mt-4 text-2xl font-semibold">

                                    </h2>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">codigo: </p>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Nombre de la Actuacion: </p>
                                </li>
                                <li class="flex items-end">
                                    <p class="text-gray-600">fecha inicio: </p>
                                <li class="flex items-end">
                                <li class="flex items-end">
                                    <p class="text-gray-600">fecha inicio: </p>
                                <li class="flex items-end">
                                    <p class="text-gray-600">Personas Asignada: </p>
                                <li class="flex items-end">
                                <li class="text-gray-600">Area de la uai: </li>
                                </li>
                                <li class="flex items-end">
                                <li class="text-gray-600">Status: </li>
                                </li>
                            </ul>

                        </div>
                    </section>
                </div>
                <a href="{{ route('designation') }}">
                    <button class="btn btn-primary" style="margin-left: 220px;">
                      
                        Designación
                    </button>
                </a>
                
                  <button class="btn btn-primary" style="margin-left: 90px;">
                      Acreditación
                  </button>
              </a>
              
            </div>
        </div>
    </div>
</x-app-layout>
