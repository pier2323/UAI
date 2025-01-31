@php
$phone_code = substr($employee->phone, 0, 4);
$phone_number = substr($employee->phone, 4,7);
@endphp

<div class="flex flex-col">
    {{-- ? Stop trying to control. --}}

    <section class="w-full">
        <h2 class="mx-auto mt-16 text-5xl font-bold max-w-7xl sm:px-6 lg:px-8 ">
            <span>{{ $employee->names(['first_name', 'first_surname']) }}</span>
        </h2>
    </section>
    
    <x-section-basic>
        
    </x-section-basic>


    <ul>
        <li class="flex items-end">
            <h2 class="mt-4 text-2xl font-semibold">
                {{ "$employee->first_name $employee->second_name $employee->first_surname $employee->second_surname" }}
            </h2>
        </li>

        <li class="flex items-end">
            <p class="text-gray-600">P00: {{ "$employee->p00" }}</p>
        </li>

        <li class="flex items-end">
            <p class="text-gray-600">Cedula: {{ "$employee->personal_id" }}</p>
            <li class="flex items-end">
                <p class="text-gray-600">Teléfono: {{ "$phone_code-$phone_number" }}</p>
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
            <li class="flex items-end">
                <p class="text-gray-600">Cargo: {{ $employee->jobTitle->name }}</p>
            </li>
        </ul>
        
</div>
