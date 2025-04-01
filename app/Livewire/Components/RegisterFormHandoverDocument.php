<?php

namespace App\Livewire\Components;

use App\Form\HandoverDocument\HandoverDocument;
use App\Form\HandoverDocument\Incoming;
use App\Form\HandoverDocument\Outgoing;
use App\Models\Departament;
use App\Models\HandoverDocument as ModelsHandoverDocument;
use App\Repositories\AuditActivityRepository;
use App\Repositories\HandoverDocumentRepository;
use App\Traits\RenderComponentTrait;
use Livewire\Attributes\Reactive;
use Livewire\Component;


class RegisterFormHandoverDocument extends Component
{
    use RenderComponentTrait;
    const view = 'livewire.audit-activity.show.register-form-handover-document';

    public Outgoing $outgoing;
    public Incoming $incoming;
    public HandoverDocument $handoverDocument;
    
    public HandoverDocumentRepository $repository;

    public ?int $handoverDocumentId;

    public object $auditActivity;

    public object $object;
    public bool $hasHandoverDocument = false;

    public $job_titles, $departaments;

    public function mount()
    {
        $this->departaments = Departament::all();
        
        if (empty($this->handoverDocumentId)) return;
        
        $repository = new HandoverDocumentRepository($this->handoverDocumentId);
        $this->object = (object) $repository->object;
        
        $this->hasHandoverDocument = isset($this->object);
        
        if($this->hasHandoverDocument) {
            $this->outgoing->load((object) $this->object->employee_outgoing);
            $this->incoming->load((object) $this->object->employee_incoming);
            $this->handoverDocument->load($this->object);
        }
    }

    public function cancel(): void
    {
        $this->resetExcept('handoverDocumentId', 'departaments', 'outgoing', 'incoming', 'handoverDocument');
        $this->mount();
    }

    public function save(): void
    {
        $this->iterator('verify');

        $this->handoverDocument->save(
            outgoing: $this->outgoing->save(),
            incoming: $this->incoming->save(),
            audit_activity_id: $this->auditActivity->id,
        );

        // $this->iterator('restart');

        $this->dispatch('saved', message: '¡Se ha guardado los datos con exito!');
    }

    public function verify(ComponentName $component): void
    {
        $this->{$component->value}->verified = false;
        $this->{$component->value}->validate();
        $this->{$component->value}->verified = true;
    }

    public function changeHandover(): void
    {
        $this->dispatch('saved', message: '¡Se ha guardado los datos con exito!');
    }

    private function iterator(string $method): void
    {
        foreach([
            ComponentName::handoverDocument, 
            ComponentName::incoming, 
            ComponentName::outgoing
        ] as $component) {$this->{$method}($component);}
    }

    private function restart(ComponentName $component): void
    {
        $this->{$component->name}->reset();
    }
}

enum ComponentName: string 
{
    case outgoing = 'outgoing';
    case incoming = 'incoming';
    case handoverDocument = 'handoverDocument';
}