<?php

namespace App\Livewire\AuditActivity;

use App\Repositories\AuditActivityRepository;
use App\Traits\RenderComponentTrait;
use Livewire\Component;

class Show extends Component
{
    use RenderComponentTrait;
    const view = "livewire.audit-activity.show";

    public AuditActivityRepository $repository;
    public object $object;
    public bool $isHandoverDocument;

    public function mount(int $id): void
    {
        $this->repository = new AuditActivityRepository($id);
        $this->object = (object) $this->repository->object;
        $this->isHandoverDocument = $this->object->type_audit['code'] == 'ae';
    }
}
