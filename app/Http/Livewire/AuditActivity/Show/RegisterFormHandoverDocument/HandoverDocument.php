<?php

namespace App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument;

use App\Models\AuditActivity;
use App\Models\EmployeeIncoming;
use App\Models\EmployeeOutgoing;
use App\Models\HandoverDocument as ModelsHandoverDocument;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HandoverDocument extends Form
{
    #[Validate('required', 'date_format:d/m/Y',  as: 'Fecha del Cese')]
    public string $cease;

    #[Validate('required', 'date_format:d/m/Y', as: 'Fecha de suscripción')]
    public string $subscription; 

    #[Validate('required', 'date_format:d/m/Y',  as: 'Fecha de recibo en la UAI')]
    public string $delivery_uai;

    public int $employee_outgoing_id, 
               $employee_incoming_id, 
               $audit_activity_id;

    public function save(EmployeeOutgoing $outgoing, EmployeeIncoming $incoming, AuditActivity $auditActivity): ModelsHandoverDocument
    {
        $this->validate();        

        $this->employee_outgoing_id = $outgoing->id;
        $this->employee_incoming_id = $incoming->id;
        $this->audit_activity_id = $auditActivity->id;

        $this->toFormatDate();

        return ModelsHandoverDocument::create($this->only([ 
        'cease', 
        'subscription', 
        'delivery_uai', 
        'employee_outgoing_id', 
        'employee_incoming_id', 
        'audit_activity_id', 
        ]));
    }

    private static function format(String $date): string 
    {
        $date = Carbon::createFromFormat("d/m/Y" ,$date);
        return $date->format('Y-m-d');
    }

    private function toFormatDate(): void
    {
        foreach (['cease', 'subscription', 'delivery_uai'] as $date) {
            $this->{$date} = self::format(date: $this->{$date});
        }
    }
}


















