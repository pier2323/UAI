<?php

namespace App\Livewire\AuditActivity;

use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\HandoverDocument;
use App\Repositories\AuditActivityRepository;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Show extends Component
{
    // #[Reactive]
    public AuditActivityRepository $auditActivity;

    public ?HandoverDocument $handoverDocument;

    public function render(): Renderable
    {
        return view('livewire.audit-activity.show');
    }

    public function mount(int $id): void
    {
        new AuditActivityRepository();
        $this->auditActivity = AuditActivity::with('typeAudit')->find($id);
        $this->handoverDocument = $this->auditActivity->handoverDocument()->first() ?? null;
    }

    public function load()
    {
        $this->handoverDocument = HandoverDocument::first() ?? null;
        return $this->handoverDocument;
    }
}
