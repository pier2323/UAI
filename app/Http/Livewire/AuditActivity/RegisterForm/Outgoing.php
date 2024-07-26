<?php

namespace App\Http\Livewire\AuditActivity\RegisterForm;

use App\Models\EmployeeOutgoing;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Outgoing extends Form
{
    // todo inputs variables 

    #[Validate('required|unique:employee_outgoing,p00|max:10|min:6', as: 'P00')]
    public $p00 = '156373'; 

    #[Validate('required|max:255|min:3', as: 'Primer Nombre')]
    public $first_name = 'jenbluk';

    #[Validate('max:255|min:3', as: 'Segundo Nombre')]
    public $second_name = 'nolan';

    #[Validate('required|max:255|min:3', as: 'Primer Apellido')]
    public $first_surname = 'vanegas';

    #[Validate('max:255|min:3', as: 'Segundo Nombre')]
    public $second_surname = 'garcia';

    #[Validate('required|max:8|min:6', as: 'Numero de telefono')]
    public $phone_number = '9915401';

    #[Validate('required|max:5|min:3', as: 'Codigo de Telefono')]
    public $phone_code = '0412';

    #[Validate('email|unique:employee_outgoing|max:255', as: 'Correo Corporativo')]
    public $email_cantv = 'jvane01@cantv.com.ve';

    #[Validate('required|email|max:255', as: 'Correo Gmail')]
    public $gmail ='jenblukvanegas@gmail.com';

    #[Validate('required|unique:employee_outgoing,personal_id|max:10|min:4', as: 'Numero de Cedula')]
    public $personal_id = '11917242';

    #[Validate('required', as: 'Cargo')]
    public $job_title_id = '';

    #[Validate('required', as: 'Unidad de Adscripcion')]
    public $departament_id = '';

    public $phone = '04129915401';
    public $query = '156373';
    public $errorMessage = '';
    public $verified = 0;

    public function mount()
    {
        // todo overwrite the data 
        $outgoing = EmployeeOutgoing::where("p00", "$this->query")->first();

        $phone_code = substr($outgoing, 0, 4);
        $phone_number = substr($outgoing, 4, -1);

        $this->p00 = $outgoing->p00;
        $this->first_name = $outgoing->first_name;
        $this->second_name =  $outgoing->second_name;
        $this->first_surname =  $outgoing->first_surname;
        $this->second_surname =  $outgoing->second_surname;
        $this->phone_number = $phone_number;
        $this->phone_code = $phone_code;
        $this->email_cantv =  $outgoing->email_cantv;
        $this->gmail =  $outgoing->gmail;
        $this->personal_id =  $outgoing->personal_id;
        $this->verified = 0;
    }
}


















