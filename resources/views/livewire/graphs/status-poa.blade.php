<?php

use Livewire\Volt\Component;
use App\Models\AuditActivity;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Illuminate\Database\Eloquent\Collection;

new class extends Component
{
    #[Reactive]
    public array $auditActivities;
    public array $config;
    public string $name = 'statusPoa';

    public function mount(): void
    {
        $this->config = $this->data();
    }

    private function data(): array
    {
        return  [
            'type' => 'pie',
            'data' => [
                'labels' => [
                    'poa',
                    'no_poa',
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
