<?php

namespace App\Form\HandoverDocument;

use App\Models\EmployeeIncoming;
use App\Models\EmployeeOutgoing;
use App\Models\HandoverDocument as ModelsHandoverDocument;
use App\Repositories\AuditActivityRepository;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

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
    public $start = '';

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

    public string|int $employee_outgoing_id = '';
    public string|int $employee_incoming_id = ''; 
    public string|int $audit_activity_id = '';

    public function save(EmployeeOutgoing $outgoing, EmployeeIncoming $incoming, ?int $audit_activity_id = null): ModelsHandoverDocument
    {
        $this->validate();     

        $this->employee_outgoing_id = $outgoing->id;
        $this->employee_incoming_id = $incoming->id;
        
        foreach (['start', 'cease', 'subscription', 'delivery_uai'] as $date) {
            $this->{$date} = self::format(date: $this->{$date});
        }

        $propertiesToSave = $this->only(self::properties);

        $propertiesToSave['audit_activity_id'] = isset($audit_activity_id) ? $audit_activity_id : null; 

        return ModelsHandoverDocument::create($propertiesToSave);
    }

    private static function format(String $date): string 
    {
        $date = Carbon::createFromFormat("d/m/Y" ,$date);
        return $date->format('Y-m-d');
    }

    public function load(object $handoverDocument): void 
    {
        foreach(self::properties as $property) {
            $this->{$property} = $handoverDocument->{$property};
        }
    }
}


















