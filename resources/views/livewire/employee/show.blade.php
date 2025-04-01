{{-- ? Stop trying to control. --}}
@php
    $fullname = "$employeeForm->first_name $employeeForm->first_surname";
    $pathProfile = Storage::url('employees/profile-photo/' . $employeeForm->profile_photo);
@endphp

@push('alert')
    <x-alert on="employee_updated"/>
@endpush

@script
<script>
    Alpine.data('show', () => ({
        isEditing: false,
        edit() {
            this.isEditing = true;
        },
        cancel() {
            this.isEditing = false;
        }
    }))
</script>
@endscript


<div class="" x-data="show">
    
    <x-section-basic class="grid grid-cols-3 auto-rows-auto gap-y-10">
        <section role="header" class="flex items-center justify-start col-span-3 pl-14">
            <figure role="profile_photo" class="">
                <img class="object-contain w-56 rounded-3xl" src="{{ $pathProfile }}" alt="{{ $fullname }}">
            </figure>
            <span role="title" class="inset-0 flex flex-col mt-auto ml-10 justify-evenly h-2/3">
                <h2 class="text-5xl font-bold text-center ">
                    {{$fullname}}
                </h2>
                <h3 class="text-4xl text-slate-800">
                    {{ ucwords($employeeForm->job_title) }}
                </h3>
            </span>
            <section role="buttons" class="inset-0 flex mx-auto">
                <figure x-show="isEditing" x-on:click="$wire.cancel(); cancel()" x-ref="figureCancel" style="width: 6.5rem; display: none"
                    class="flex items-center justify-between p-2 mr-2 transition-all bg-red-100 rounded-full hover:bg-red-200 active:bg-red-300" 
                    {{-- x-on:mouseover="$refs.buttonCancel.classList.remove('w-0'); $refs.figureCancel.style.width = '6.5rem'"
                    x-on:mouseout="$refs.buttonCancel.classList.add('w-0'); $refs.figureCancel.style.width = '2.5rem'" --}}
                >
                    <p class="pl-2 font-semibold" x-ref="buttonCancel">Cancelar</p>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#434343"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </figure>      
    
                <figure x-show="!isEditing" x-on:click="$wire.isDeleting = true" x-ref="figureDelete" style="width: 6.5rem;"
                    class="flex items-center justify-between p-2 mr-2 transition-all bg-red-100 rounded-full hover:bg-red-200 active:bg-red-300" 
                    {{-- x-on:mouseover="$refs.buttonDelete.classList.remove('w-0'); $refs.figureDelete.style.width = '6.5rem'"
                    x-on:mouseout="$refs.buttonDelete.classList.add('w-0'); $refs.figureDelete.style.width = '2.5rem'" --}}
                >
                    <p class="pl-2 font-semibold " x-ref="buttonDelete">Eliminar</p>
                    <svg style="width: 24px!important" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                </figure> 
                
                <figure x-show="!isEditing" x-on:click="edit()" x-ref="figureEdit" style="width: 6.5rem;"
                    class="flex items-center justify-between p-2 transition-all bg-yellow-100 rounded-full hover:bg-yellow-200 active:bg-yellow-300"
                    {{-- x-on:mouseover="$refs.buttonEdit.classList.remove('w-0'); $refs.figureEdit.style.width = '5.5rem'" 
                    x-on:mouseout="$refs.buttonEdit.classList.add('w-0'); $refs.figureEdit.style.width = '2.5rem'" --}}
                >
                    <p class="pl-2 font-semibold" x-ref="buttonEdit">Editar</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z"/></svg>
                </figure>     
            </section>
        </section>
        <div class="col-span-3 ">
            <hr class="mb-3">
            <h3 class="col-span-3 pl-16 text-3xl font-bold ">Informacion Personal</h3>
        </div>
        <ul class="col-span-3 pl-16 space-y-2 text-lg text-gray-800 columns-2">
            <li role="Names" class="mb-3">
                <strong class="block float-left mb-2 text-xl">Nombre Completo:</strong>                            
                <span class="block clear-both text-xl">{{ ucwords(strtolower($employeeModel->names())) }}</span> 
            </li>
            <li role="P00" class="mb-3">
                <strong class="block float-left mb-2 text-xl">P00:</strong>
                <span class="block clear-both text-xl">{{ $employeeForm->p00 }}</span>
            </li>
            <li role="Personal ID" class="mb-3">
                <strong class="block float-left mb-2 text-xl">Cédula:</strong>
                <span class="block clear-both text-xl">{{ $employeeForm->personal_id }}<span>
            </li>
            <li role="Phone" class="mb-3">
                <strong class="block float-left mb-2 text-xl">Teléfono:</strong>
                <span class="block clear-both text-xl">{{ $employeeForm->phone_code . "-" . $employeeForm->phone_number }}<span>
            </li>
            <li role="Email CANTV" class="mb-3">
                <strong class="block float-left mb-2 text-xl">Correo Institucional:</strong>
                <span class="block clear-both text-xl">{{ $employeeForm->email_cantv }}<span>
            </li>
            <li role="Gmail" class="mb-3">
                <strong class="block float-left mb-2 text-xl">Correo Personal:</strong>
                <span class="block clear-both text-xl">{{ $employeeForm->gmail }}<span>
            </li>
            <li  role="Cargo" class="mb-3">
                <strong class="block float-left mb-2 text-xl">Cargo:</strong>
                <span class="block clear-both text-xl">{{ ucwords($employeeForm->job_title) }}<span>
            </li>
            <li  role="Area UAI" class="mb-3">
                <strong class="block float-left mb-2 text-xl">Area UAI:</strong>
                <span class="block clear-both text-xl">{{ ucwords($employeeForm->uai) }}<span>
            </li> 
        </ul>
    </x-section-basic>
    <x-dialog-modal wire:model="isDeleting" id='deleteModal' maxWidth='sm'>
        <x-slot name="title"><h5 class="flex justify-center w-full">¿Está seguro que desea eliminar el usuario {{ucwords(strtolower($fullname))}}?</h5></x-slot>
        <x-slot name="footer">
            <x-button type="button" class="mr-2" wire:click="delete">Si</x-button>
            <x-secondary-button type="button" x-on:click="$wire.isDeleting = false">No</x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    
</div>
