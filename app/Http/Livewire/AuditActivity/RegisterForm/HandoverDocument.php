<?php

namespace App\Http\Livewire\AuditActivity\RegisterForm;

use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HandoverDocument extends Form
{
    // todo inputs variables 
    #[Validate('required|max:255', as: 'Codigo')]
    public $code;
    
    #[Validate('required|max:255', as: 'Nombre')]
    public $name; 

    #[Validate('required|max:255', as: 'Objetivo')]
    public $target;

    #[Validate('required', as: 'Fecha del Cese')]
    public $cease;

    #[Validate('required', as: 'Fecha de suscripción')]
    public $subscription;

    #[Validate('required', as: 'Fecha de recibo en la UAI')]
    public $delivery_uai;

    // todo relations 
    public 
    $employee_outgoing_id, 
    $employee_incoming_id, 
    $audit_activity_id;

    public $verified = 0;


    public function mount()
    {
        $this->verified = 0;
    }

    protected function format(String $date)
    {
        $date = Carbon::createFromFormat("d/m/Y" ,$date);
        return $date->format('Y-m-d');
    }

    public function toFormatDate()
    {
        foreach (['cease', 'subscription', 'delivery_uai'] as $date) {
            $this->{$date} = HandoverDocument::format(date: $this->{$date});
        }
    }
}


















