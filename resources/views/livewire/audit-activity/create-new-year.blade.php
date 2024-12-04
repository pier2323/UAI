<?php

new class extends \Livewire\Volt\Component
{
    public int $year;
    public bool $open = false;

    public function mount(): void
    {
        $this->year = \App\Models\AuditActivity::distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->first() + 1;
    }
}; ?>

<div class="flex flex-col items-center justify-center w-full h-full py-28">

    <h4 class="w-3/5">

        <div
            class="flex items-center justify-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50"
            role="alert"
        >
            <svg
                class="flex-shrink-0 inline w-6 h-6 me-3"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Información</span>
            <div class="text-2xl font-semibold">
                <span class="mr-2 font-bold">Aviso!</span>
                <span class="">No hay Año Fiscal Abierto.</span>
            </div>
        </div>
    </h4>

    <button class="flex items-center justify-center w-3/5 px-5 py-3 mb-2 text-xl font-medium text-center text-white rounded-lg bg-gradient-to-r hover:bg-gradient-to-br focus:ring-4 focus:outline-none "
    :class="$wire.open == false
    ? 'from-blue-500 via-blue-600 to-blue-700 focus:ring-blue-300'
    : 'from-red-500 via-red-600 to-red-700 focus:ring-red-300'"
        type="button"
        x-on:click="$wire.open = !$wire.open"
        x-text="$wire.open == false
        ? 'Abrir Año Fiscal {{ $year }}'
        : 'Cerrar'
        "
    >

        Abrir Año Fiscal {{ $year }}
    </button>

    <div x-show="$wire.open" class="w-3/5 p-10 bg-slate-100">
    <livewire:AuditActivity.Loader>
    </div>
</div>
