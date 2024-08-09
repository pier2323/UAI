<?php

namespace App\Http\Livewire\AuditActivity;

use App\Http\Livewire\AuditActivity\Show\Schedule;
use App\Models\AuditActivity;
use App\Models\Employee;
use App\Services\DesignationService;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{
    public $auditActivity;
    public $employees = [];
    public Schedule $schedule;

    public function mount($id)
    {
        $this->auditActivity = AuditActivity::find($id);
    }

    public function render()
    {
        return view('livewire.audit-activity.show');
    }

    public function save()
    {
        // dd($this->employees);

        $format = 'd/m/Y';
        $dates = [
            'planning_start',
            'planning_end',
            'execution_start',
            'execution_end',
            'preliminary_start',
            'preliminary_end',
            'download_start',
            'download_end',
            'definitive_start',
            'definitive_end',
        ];

        foreach ($this->schedule->only($dates) as $key => $value) {
            $carbon = Carbon::createFromFormat($format, $value);
            $this->schedule->{$key} = $carbon->format('Y-m-d');
        }

        
        $this->auditActivity->update($this->schedule->toArray());
        $this->auditActivity->employee()->sync($this->employees);
    }

    public function deleteCard($id)
    {
       $employee = array_search($id ,$this->employees);
        if ($employee !== false) {
            array_splice($this->employees, $employee, 1);
        }
    }

    public function addCard($id)
    {
        array_push($this->employees, $id);
        return Employee::with('jobTitle')->find($id);
    }

    public function getDesignationDocument(DesignationService $designation)
    {
       return $designation->generate($this->auditActivity);
    }
}
