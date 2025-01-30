{{-- ? The best athlete wants his opponent at his best. --}}
<x-section-basic>
    <section>
        <h2 class="flex justify-between w-full px-12 my-10 text-5xl font-bold">
            <span>Personal</span>
        </h2>
    </section>
    <div class="m-12">
        <livewire:employee.registerForm>
    </div>
    <livewire:employee.tableEmployee :$employees />
</x-section-basic>

