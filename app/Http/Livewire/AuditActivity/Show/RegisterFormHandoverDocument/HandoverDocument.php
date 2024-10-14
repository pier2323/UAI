<?php

namespace App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument;

use App\Models\AuditActivity;
use App\Models\EmployeeIncoming;
use App\Models\EmployeeOutgoing;
use App\Models\HandoverDocument as ModelsHandoverDocument;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;
use PhpParser\Node\Stmt\Else_;

class HandoverDocument extends Form
{
    const array properties = [ 
        'start',
        'cease', 
        'subscription', 
        'delivery_uai', 
        'departament', 
        'departament_affiliation', 
        'employee_outgoing_id', 
        'employee_incoming_id', 
        'audit_activity_id',
    ];

    
    #[Validate('nullable', 'date_format:d/m/Y',  as: 'Fecha de Inicio del Periodo')]
    public string $start = '';

    #[Validate('nullable', 'date_format:d/m/Y',  as: 'Fecha del Cese')]
    public string $cease = '';

    #[Validate('nullable', 'date_format:d/m/Y', as: 'Fecha de suscripción')]
    public string $subscription = ''; 

    #[Validate('nullable', 'date_format:d/m/Y',  as: 'Fecha de recibo en la UAI')]
    public string $delivery_uai = '';

    #[Validate('nullable', as: 'Unidad que Entrega')]
    public $departament = '';

    #[Validate('nullable', as: 'Unidad de Adscripcion')]
    public $departament_affiliation = '';

    public ?int $employee_outgoing_id;
    public ?int $employee_incoming_id; 
    public string|int|null $audit_activity_id;

    public function save(
        EmployeeOutgoing $outgoing, 
        EmployeeIncoming $incoming, 
        ?AuditActivity $auditActivity
    ): ModelsHandoverDocument
    {
        $this->validate();     

        $this->employee_outgoing_id = $outgoing->id;
        $this->employee_incoming_id = $incoming->id;

        if(isset($auditActivity))
        $this->audit_activity_id = $auditActivity->id;
        
        $this->toFormatDate();

        if(isset($auditActivity))
        return ModelsHandoverDocument::create($this->propertiesToSave());

        else {
            $propertiesToSave = $this->propertiesToSave(audit_activity: false);
            $propertiesToSave['audit_activity_id'] = null;
            
            return ModelsHandoverDocument::create($propertiesToSave);
        }

    }

    private static function format(String $date): string 
    {
        $date = Carbon::createFromFormat("d/m/Y" ,$date);
        return $date->format('Y-m-d');
    }

    private function toFormatDate(): void
    {
        foreach (['start', 'cease', 'subscription', 'delivery_uai'] as $date) {
            $this->{$date} = self::format(date: $this->{$date});
        }
    }

    private function propertiesToSave(bool $audit_activity = true): array
    {
        if(!$audit_activity) {
            return array_filter(self::properties, function($value) {
                return $value !== 'audit_activity_id';
            });
        };

        return $this->only(self::properties);
    }

    public function load(ModelsHandoverDocument $handoverDocument): void 
    {
        foreach(self::properties as $property) {
            $this->{$property} = $handoverDocument->$property;
        }
    }

}


















