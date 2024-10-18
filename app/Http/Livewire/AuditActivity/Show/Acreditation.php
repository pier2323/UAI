<?php

namespace App\Http\Livewire\AuditActivity\Show;

use App\Models\Acreditation as ModelsAcreditation;
use App\Models\AuditActivity;
use App\Services\AcreditationService;
use Carbon\Carbon;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Acreditation extends Component
{
    public AuditActivity $auditActivity;
    public ?ModelsAcreditation $acreditation;
    public ?string $accreditDateRelease;
    public bool $openModalAcreditation = false;

    public function render()
    {
        return view('livewire.audit-activity.show.acreditation');
    }

    public function acredit(): void
    {
        $dateCarbon = Carbon::createFromFormat('d/m/Y', $this->accreditDateRelease);
        $this->acreditation = ModelsAcreditation::create([
            'date_release' => $dateCarbon->format('Y-m-d'), 
            'pivot_id' => $this->auditActivity->employee()->first()->pivot->id,
        ]);

        $this->dispatch('acreditation_download', message: \__('se ha acreditado la comisión correctamente!'));
    }
    
    #[Renderless]
    public function getAcreditationDocument(): BinaryFileResponse
    {
        $acreditation = new AcreditationService($this->auditActivity, date: $this->acreditation->date_release);
        $this->dispatch('acreditation_acredit', message: \__('se ha iniciado la descarga!'));
        return $acreditation->download();
    }
}
