<?php

use Livewire\Volt\Component;
use App\Models\AuditActivity;
use Livewire\Attributes\Reactive;

new class extends Component
{
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
