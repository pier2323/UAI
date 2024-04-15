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
            <div style="overflow:hidden ; border: 1px solid #777; border-radius: 20px" class="border-slate-500">
              <img alt="foto de perfil" style="width: 15vw" src="{{ "$personal->foto_perfil" }}" />
            </div>
            <div class="border- mr-4 w-full text-center sm:w-1/2 sm:text-left">

              <ul class="mb-8 flex flex-col items-center space-y-1 dark:text-slate-400 sm:items-start">
                <li class="flex items-end">
                  <h2 class="mt-4 text-2xl font-semibold">
                    {{ "$personal->primer_nombre $personal->segundo_nombre $personal->primer_apellido $personal->segundo_apellido" }}
                  </h2>
                </li>
                <li class="flex items-end">
                  <p class="text-gray-600">Cargo: {{ $personal->cargo->nombre }}</p>
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
                <a href="{{route('personal-uai.edit', $personal->id)}}">
                  <button
                    class="rounded-lg border-0 bg-slate-900 px-6 py-3 text-base text-white shadow-lg shadow-slate-600 transition hover:bg-blue-600 hover:text-slate-900 hover:shadow-blue-600 dark:bg-blue-600 dark:text-black dark:shadow-sm dark:shadow-blue-600 dark:hover:bg-blue-400 sm:py-2">
                    Editar
                  </button>
                </a>
                <a href="{{route('personal-uai.delete', $personal->id)}}">
                  <button
                    class="rounded-lg border-0 bg-white px-6 py-3 text-base text-slate-900 shadow-lg shadow-slate-100 transition hover:bg-blue-300 hover:text-slate-900 hover:shadow-blue-600 dark:bg-slate-700 dark:text-slate-300 dark:shadow-sm dark:shadow-slate-800 dark:hover:bg-slate-600 sm:py-2">
                    Eliminar Datos
                  </button>
                </a>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
