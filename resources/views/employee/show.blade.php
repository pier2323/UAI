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
            <div style="overflow:hidden ; border: 1px solid #525252; border-radius: 20px" class="border-slate-500">
              <img alt="foto de perfil" style="width: 15vw"src="{{ "/storage/$employee->profile_photo" }}" />
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

           

              <div class="flex flex-col space-y-3 md:flex-row md:space-x-2 md:space-y-0">
                <a href="{{ route('employee.edit', $employee->id) }}">
                  <button
                    class="rounded-lg border-0 bg-slate-900 px-6 py-3 text-base text-white shadow-lg shadow-slate-600 transition hover:bg-blue-600 hover:text-slate-900 hover:shadow-blue-600 dark:bg-blue-600 dark:text-black dark:shadow-sm dark:shadow-blue-600 dark:hover:bg-blue-400 sm:py-2">
                    Editar
                  </button> 
                </a>
                <form action="{{ route('employee.index', $employee->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="rounded-lg border-0 bg-white px-6 py-3 text-base text-slate-900 shadow-lg shadow-slate-100 transition hover:bg-blue-300 hover:text-slate-900 hover:shadow-blue-600 dark:bg-slate-700 dark:text-slate-300 dark:shadow-sm dark:shadow-slate-800 dark:hover:bg-slate-600 sm:py-2">
                    Eliminar Datos
                  </button>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
