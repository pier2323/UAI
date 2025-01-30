<?php

use Livewire\Volt\Component;
use App\Models\AuditActivity;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Illuminate\Database\Eloquent\Collection;

/**
 * todo Este componente tiene como funcionalidad preparar los datos y utilizarlos en una grafica de barras donde se contrasta cuantos Actuaciones fiscales hay por tipo 
*/ 
new class extends Component
{
    /**
     * ? almacena todo el json de configuracion y datos para usarlo en el grafico 
     * @var array $config
    */
    public array $config;

    /**
     * ? nombre del grafico 
    */
    public string $name = 'statusTypeAudit';

    /**
     * ? un array asociativo donde las claves son el nombre de los tipos de Actuaciones Fiscales y el valor es la cantidad de Actuaciones Fiscales que tiene ese tipo 
     * @var array $typeAudits
    */
    public array $typeAudits = array();

    /**
     * todo carga la variable los tipos de Auditoría y Carga las configuraciones del json del gráfico 
     * @return void
    */
    public function mount(): void
    {
        foreach(App\Models\TypeAudit::with('auditActivity')->get() as $type)
        $this->typeAudits[$type->name] = $type->auditActivity->count();

        $this->config = $this->data();
    }

    /**
     * todo estructura la informacion del json y lo retorna en forma de array 
     * @return array
    */
    private function data(): array
    {
        $data = [
            'labels' => array_keys($this->typeAudits),
            'datasets' => [[
                'label' => [],
                'data' => array_values($this->typeAudits),
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                'borderColor' => [
                    'rgb(255, 99, 132)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                'borderWidth' => 1,
            ],],
        ];

        $config = [
            'type' => 'bar',
            'data' => $data,
            'options' => [
                'scales' => [
                    'y' => [ 'beginAtZero' => true]
                ]
            ],
        ];

        return $config;
    }

    /**
     * todo se dispara por el evento 'refresh' y actualiza las variables y dispara el evento graph-statustypeaudit
     * @return void
    */
    #[On('refresh')]
    public function updateGraph(): void
    {
        $this->mount();
        $this->dispatch('graph-' . strtolower($this->name));
    }

};
?>

<x-chart name="{{ $name }}" style="width: 700px;" width='700px' height='400px'/>
