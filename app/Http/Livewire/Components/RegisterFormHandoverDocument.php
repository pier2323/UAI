<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument\HandoverDocument;
use App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument\Incoming;
use App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument\Outgoing;
use App\Models\AuditActivity;
use App\Models\Departament;
use App\Models\HandoverDocument as ModelsHandoverDocument;
use Livewire\Attributes\Reactive;
use Livewire\Component;

enum ComponentName: string 
{
    case outgoing = 'outgoing';
    case incoming = 'incoming';
    case handoverDocument = 'handoverDocument';
}

class RegisterFormHandoverDocument extends Component
{
    public Outgoing $outgoing;
    public Incoming $incoming;
    public HandoverDocument $handoverDocument;
    
    #[Reactive]
    public ?ModelsHandoverDocument $modelsHandoverDocument;
    
    public ?AuditActivity $auditActivity;

    public $job_titles, $departaments;

    public function render()
    {
        return view('livewire.audit-activity.show.register-form-handover-document');
    }

    public function mount()
    {
        if(isset($this->modelsHandoverDocument) && isset($this->auditActivity)) {
            dd(isset($this->auditActivity));
            $this->outgoing->load($this->modelsHandoverDocument->employeeOutgoing()->first());
            $this->incoming->load($this->modelsHandoverDocument->employeeIncoming()->first());
            $this->handoverDocument->load($this->modelsHandoverDocument);
        }
        $this->departaments = Departament::all();
    }

    public function save(): void
    {
        $this->iterator('verify');

        $this->handoverDocument->save(
            $this->outgoing->save(),
            $this->incoming->save(),
            isset($this->auditActivity) ? $this->auditActivity : null,
        );

        $this->iterator('restart');

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
