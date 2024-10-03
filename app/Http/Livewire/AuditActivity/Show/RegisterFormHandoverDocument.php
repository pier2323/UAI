<?php

namespace App\Http\Livewire\AuditActivity\Show;

use App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument\HandoverDocument;
use App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument\Incoming;
use App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument\Outgoing;
use App\Models\AuditActivity;
use App\Models\Departament;
use App\Models\JobTitle;
use LaraDumps\LaraDumps\Livewire\Attributes\Ds;
use Livewire\Component;

enum ComponentName: string 
{
    case outgoing = 'outgoing';
    case incoming = 'incoming';
    case handoverDocument = 'handoverDocument';
}

#[Ds]
class RegisterFormHandoverDocument extends Component
{
    public AuditActivity $auditActivity;
    public Outgoing $outgoing;
    public Incoming $incoming;
    public HandoverDocument $handoverDocument;

    public $job_titles, $departaments;

    public function render()
    {
        return view('livewire.audit-activity.show.register-form-handover-document');
    }

    public function mount()
    {
        $this->job_titles = JobTitle::all();
        $this->departaments = Departament::all();
    }

    public function save(): void
    {
        $this->handoverDocument->save(
            $this->outgoing->save(),
            $this->incoming->save(),
            $this->auditActivity,
        );

        $this->dispatch('saved', message: ' ¡Se ha guardado los datos con exito!');
    }

    public function verify(ComponentName $component): void
    {
        $this->{$component->value}->verified = false;
        $this->{$component->value}->validate();
        $this->{$component->value}->verified = true;
    }
}
