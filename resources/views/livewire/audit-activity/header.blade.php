<?php

use Livewire\Volt\Component;
use App\Models\AuditActivity;
use Livewire\Attributes\Reactive;

/**
 *  todo Este componente livewire/volt tiene como funcion encapsular y dividir las gráficas y la parte inicial (Cabecera/Header) del contenido principal del pagina 
 */
new class extends Component
{
    /**
     * ? Array php que tiene los datos del AuditActivity filtrados por su columna 'is_poa' con valor true, en formato deseado:
     * [
     * 'AuditActivityPoa' => valores is_poa en true, 
     * 'AuditActivityNoPoa' =>  valores is_poa en false,
     * ] 
     * @attribute \Livewire\Attributes\Reactive
     * @var array $auditActivities 
    */ 
    #[Reactive]
    public array $auditActivities;

    public \App\Models\Year $year;
}; ?>

<div>
    {{-- ? If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <section>
        <h2 class="flex justify-between w-full my-10 text-5xl font-bold px-36">
            <span>Plan Operativo Anual</span>
            <div class="px-4 py-2 bg-white rounded-lg shadow-lg">
                <span>{{ $year->active }}</span>
            </div>
        </h2>
    </section>
    <div class="flex justify-between w-full mt-2 px-36" role="graphs">
        <div class="flex flex-col items-center px-4 py-3 bg-white rounded-lg shadow-lg">
            <span class="font-semibold">Cantidad de Actuaciones Planificadas y No Planificadas</span>
            <div class="flex items-center justify-center h-full">
                <livewire:graphs.status-poa :$auditActivities>
            </div> 
        </div>
        <div class="flex flex-col items-center px-4 py-3 bg-white rounded-lg shadow-lg">
            <span class="font-semibold">Cantidad de Actuaciones por tipo</span>
            <div class="flex items-center justify-center h-full">
                <livewire:graphs.status-type-audit :$auditActivities>
            </div>
        </div>
    </div>
</div>
