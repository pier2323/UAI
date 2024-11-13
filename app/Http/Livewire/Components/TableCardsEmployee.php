<?php

namespace App\Http\Livewire\Components;

use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class TableCardsEmployee extends Component
{
    #[Modelable]
    public array $employees;

    #[Reactive]
    public ?array $errors;

    #[Reactive]
    public bool $isEditing = true;

    #[Reactive]
    public bool $isCreated = false;

    #[Locked]
    public AuditActivity $auditActivity;

    public function render():Renderable
    {
        return view('livewire.components.table-cards-employee');
    }

    #[Renderless]
    public function addCard($id):Employee
    {
        return Employee::with('jobTitle')->find($id);
    }

    #[On('cancelEdit')]
    public function cancelEdit(): void
    {
        $this->load();
    }

    public function load(): void
    {
        $employees = array();
        foreach($this->auditActivity->employee()->get() as $employee) {

            $employee->jobTitle->first();

            array_push($employees, [
                'data' => $employee,
                'role' => $employee->pivot->role,
            ]);
        }

        $this->employees = $employees;
    }
}
