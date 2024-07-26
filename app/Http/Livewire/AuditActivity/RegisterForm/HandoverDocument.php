<?php

namespace App\Http\Livewire\AuditActivity\RegisterForm;

use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HandoverDocument extends Form
{
    // todo inputs variables 
    
    #[Validate('required|max:255', as: 'Nombre')]
    public $name = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur minima nam est ipsum'; 

    #[Validate('required|max:255', as: 'Objetivo')]
    public $target = 'Pariatur minima nam est ipsum';

    #[Validate('required|date', as: 'Fecha del Cese')]
    public $cease = '12/12/2003';

    #[Validate('required|date', as: 'Fecha de suscripción')]
    public $subscription = '12/12/2003';

    #[Validate('required|date', as: 'Fecha de recibo en la UAI')]
    public $delivery_uai = '12/12/2003';

    // todo relations 
    public 
    $employee_outgoing_id, 
    $employee_incoming_id, 
    $audit_activity_id;

    public $verified = 0;


    public function mount()
    {
        $this->name = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur minima nam est ipsum'; 
        $this->target = 'Pariatur minima nam est ipsum';
        $this->cease = '12/12/2003';
        $this->subscription = '12/12/2003';
        $this->delivery_uai = '12/12/2003';
        $this->verified = 0;
    }

    protected function format(String $date)
    {
        $date = Carbon::parse($date);
        return $date->format('d-m-Y');
    }

    public function toFormatDate()
    {
        foreach (['cease', 'subscription', 'delivery_uai'] as $date) {
            $this->{$date} = HandoverDocument::format(date: $this->{$date});
        }
    }
}


















