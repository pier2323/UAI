<?php

namespace App\Http\Livewire\AuditActivity\RegisterForm;

use App\Models\EmployeeOutgoing;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Outgoing extends Form
{
    // todo inputs variables 
    #[Validate('required|unique:employee_outgoing,p00|max:10|min:6', as: 'P00')]
    public $p00; 

    #[Validate('required|max:255|min:3', as: 'Primer Nombre')]
    public $first_name;

    #[Validate('max:255|min:3', as: 'Segundo Nombre')]
    public $second_name;

    #[Validate('required|max:255|min:3', as: 'Primer Apellido')]
    public $first_surname;

    #[Validate('max:255|min:3', as: 'Segundo Nombre')]
    public $second_surname;

    #[Validate('required|max:8|min:6', as: 'Numero de telefono')]
    public $phone_number;

    #[Validate('required|max:5|min:3', as: 'Codigo de Telefono')]
    public $phone_code;

    #[Validate('email|unique:employee_outgoing|max:255', as: 'Correo Corporativo')]
    public $email_cantv;

    #[Validate('required|email|max:255', as: 'Correo Gmail')]
    public $gmail;

    #[Validate('required|unique:employee_outgoing,personal_id|max:10|min:4', as: 'Numero de Cedula')]
    public $personal_id;

    #[Validate('required', as: 'Cargo')]
    public $job_title_id;

    #[Validate('required', as: 'Unidad de Adscripcion')]
    public $departament_id;

    public $phone;
    public $query;
    public $errorMessage;
    public $verified = 0;
}


















