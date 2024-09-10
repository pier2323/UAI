<?php

namespace App\Http\Livewire\Components;

use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\AuditActivityEmployee;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class TableCardsEmployee extends Component
{
    public array $employees = array();

    #[Locked]
    public AuditActivity $auditActivity;
    public Designation|null $designation;
    public Acreditation|null $acreditation;

    public function render():Renderable
    {
        return view('livewire.components.table-cards-employee');
    }

    public function mount():void
    {
        if (isset($this->designation)) {
            foreach($this->auditActivity->employee()->get() as $employee) {
                
                $employee->jobTitle->first();

                array_push($this->employees, [
                    'data' => $employee, 
                    'role' => $employee->pivot->role,
                ]);
            }
        }
    }

    #[Renderless, On('saving')]
    public function save():void
    {
        // todo sync employees 
        $this->auditActivity->employee()->detach();

        foreach ($this->employees as $employee) {
            $key = $employee['data']['id'];
            $role = $employee['role'] == 1 
            ? 'Coordinador'
            : 'Auditor';
            
            $this->auditActivity->employee()->attach([$key => [
                'role' => "$role"]
            ]);
        }

        Designation::create([
            'date_release' => $this->auditActivity->planning_start, 
            'pivot_id' => AuditActivityEmployee::where('audit_activity_id', $this->auditActivity->id)->first()->id,
        ]);
    }

    #[Renderless]
    public function addCard($id):Employee
    {
        return Employee::with('jobTitle')->find($id);
    }
    
    #[Renderless]
    public function prepare($employees):void
    {
        $this->employees = $employees;
    }
}
