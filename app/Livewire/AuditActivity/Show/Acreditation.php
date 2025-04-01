<?php

namespace App\Livewire\AuditActivity\Show;

use App\Models\AuditActivityEmployee;
use App\Repositories\AuditActivityRepository;
use App\Services\AcreditationService;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Actions\AuditActivityActions\AcreditComissionAction;
use App\Repositories\AcreditationRepository;
use App\Traits\RenderComponentTrait;
use Carbon\Carbon;

class Acreditation extends Component
{
    use RenderComponentTrait;
    const view = 'livewire.audit-activity.show.acreditation';

    #[Reactive]
    public AuditActivityRepository $repository;
    
    public ?AcreditationRepository $acreditation;
    
    public object $object;
    public ?string $accreditDateRelease;
    public bool $openModalAcreditation = false;

    public function acredit(AcreditComissionAction $action): void
    {
        $acreditationModel = $action($this->accreditDateRelease, $this->object->id);

        $this->acreditation = new AcreditationRepository($acreditationModel->id);

        $this->dispatch('acreditation_acredit', message: \__('se ha acreditado la comisión correctamente!'));
    }

    #[Renderless]
    public function getAcreditationDocument(): BinaryFileResponse
    {
        $code = $this->object->code;
        $date_release = Carbon::createFromFormat('d/m/Y', $this->acreditation->object['date_release']);

        $document = new AcreditationService(
            repository: $this->repository, 
            date: $date_release,
            nameDocument: "UAI-GCP-ACRE-COM $code.docx"
        );

        $this->dispatch('acreditation_download', message: \__('se ha iniciado la descarga!'));
        return $document->download();
    }
}
