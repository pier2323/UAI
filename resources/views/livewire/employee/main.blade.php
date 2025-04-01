{{-- ? The best athlete wants his opponent at his best. --}}
<x-section-basic>
    <section>
        <h2 class="flex justify-between w-full px-12 my-10 text-5xl font-bold">
            Personal
        </h2>
    </section>
    <div class="m-12">
        <x-button x-on:click="$wire.newPersonalModal = true">Registrar nuevo personal</x-button>
        <livewire:employee.registerForm wire:model="newPersonalModal">
    </div>
    <livewire:employee.tableEmployee :$employees />
</x-section-basic>

