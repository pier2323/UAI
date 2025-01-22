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
}; ?>

<div >
    {{-- ? If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="flex justify-between w-full px-52" role="graphs">
        <livewire:graphs.status-poa :$auditActivities>
        <livewire:graphs.status-type-audit :$auditActivities>
    </div>
</div>
