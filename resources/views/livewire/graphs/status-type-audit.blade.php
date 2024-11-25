<?php

use Livewire\Volt\Component;
use App\Models\AuditActivity;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Illuminate\Database\Eloquent\Collection;

new class extends Component
{
    public array $config;
    public string $name = 'statusTypeAudit';
    public array $typeAudits = array();

    public function mount(): void
    {
        foreach(App\Models\TypeAudit::with('auditActivity')->get() as $type)
        $this->typeAudits[$type->name] = $type->auditActivity->count();

        $this->config = $this->data();
    }

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

    #[On('refresh')]
    public function updateGraph(): void
    {
        $this->mount();
        $this->dispatch('graph-' . strtolower($this->name));
    }

};
?>

<x-chart name="{{ $name }}" style="width: 700px;" width='700px' height='400px'/>
