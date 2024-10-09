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
    public ?Acreditation $acreditation;
    public ?Designation $designation;
    public bool $designated = false;

    public function designatedFunction()
    {
        $this->designated = true;
    }

    public function render(): Renderable
    {
        return view('livewire.audit-activity.show');
    }

    public function mount(): void
    {
        if ($this->auditActivity->isDesignated()) $this->designation = $this->auditActivity->designation()->first();
        if ($this->auditActivity->isAcredited()) $this->acreditation = $this->auditActivity->acreditation()->first();
        $this->handoverDocument = $this->auditActivity->handoverDocument()->first() ?? null;
    }
    
}