<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\HandoverDocument;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Show extends Component
{
    #[Locked]
    public AuditActivity $auditActivity;

    public ?HandoverDocument $handoverDocument;

    public function render(): Renderable
    {
        return view('livewire.audit-activity.show');
    }

    public function mount(int $public_id): void
    {
        $this->auditActivity = AuditActivity::where('public_id', $public_id)->first();
        $this->handoverDocument = $this->auditActivity->handoverDocument()->first() ?? null;
    }

    public function load()
    {
        $this->handoverDocument = HandoverDocument::first() ?? null;
        return $this->handoverDocument;
    }
}
