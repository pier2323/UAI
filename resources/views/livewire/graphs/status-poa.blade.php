<?php

use Livewire\Volt\Component;
use App\Models\AuditActivity;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Illuminate\Database\Eloquent\Collection;

/**
 * todo Este componente tiene como funcionalidad preparar los datos y utilizarlos en una grafica de barras donde se contrasta cuantos Actuaciones fiscales hay Poa y No Poa 
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

    /**
     * ? almacena todo el json de configuracion y datos para usarlo en el grafico 
     * @var array $config
    */ 
    public array $config;

    /**
     * ? nombre del grafico 
     * @var string $name
    */ 
    public string $name = 'statusPoa';

    /**
     * todo carga la variable config con los datos de configuracion del grafico 
     * @return void
    */ 
    public function mount(): void
    {
        $this->config = $this->data();
    }

    /**
     * todo estructura toda la informacion del grafico en un array y la retorna 
     * @return array
    */ 
    private function data(): array
    {
        return  [
            'type' => 'pie',
            'data' => [
                'labels' => [
                    'POA',
                    'NO POA',
                ],
                'datasets' => [[
                    // 'hoverOffset' => 4,
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(42, 90, 200)'
                    ],
                    'data' => [
                        $this->auditActivities['poa']->count() ?? 0,
                        $this->auditActivities['no_poa']->count() ?? 0,
                    ],
                ]],
            ],
        ];
    }

    /**
     * todo espera el evento refresh y actualiza la variable $config y dispara un eveto con el nombre graph-statuspoa 
     * @return void
    */
    #[On('refresh')]
    public function updateGraph(): void
    {
        $this->config = $this->data();
        $this->dispatch('graph-' . strtolower($this->name));
    }

};
?>

<div>
<x-chart name="{{ $name }}" default width='256px' height='256px'/>
</div>
