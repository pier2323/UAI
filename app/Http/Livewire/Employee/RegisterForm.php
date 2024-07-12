<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Uai;
use Faker\Provider\en_SG\PhoneNumber;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;


class RegisterForm extends Component
{
    use WithFileUploads;


    #[Validate('numeric|required|unique:employee,p00|min:5', as: 'p00')]
    public $p00;
    #[Validate('alpha|required|min:3|max:500', as: 'Primer Nombre')]
    public $first_name;
    #[Validate('max:500', as: 'Segundo Nombre')]
    public $second_name;
    #[Validate('alpha|required| min:3|max:500', as: 'Primer Apellido ')]
    public $first_surname;
    #[Validate('max:500', as: 'Segundo Apellido')]
    public $second_surname;
    public $phone;
    #[validate('required|email|unique:employee,email_cantv', as: 'Correo Corporativo')]
    public $email_cantv;
    #[validate('required|email', as: 'Correo Personal')]
    public $gmail;
    #[Validate('required|image|mimes:jpg,png,|max:4096 ', as: 'Foto')]
    public $photo;
    #[validate('required', as: 'cargo')]
    public $job_title;
    #[validate('required', as: 'Coordinación o Gerencia ')]
    public $uai;
    #[validate('required|numeric|min:8|unique:employee,personal_id', as: ' Numero de cedula')]
    public $personal_id;


    public $isOpened = false;
    public $test;
    public $jobTitles = [];
    public $uais = [];

    public $phone_code;
    public $valido;

    #[validate('required|numeric|min:9 |unique:employee,phone', as: ' Numero de Telefono')]
    public $phone_number;



    public function mount()
    {
        $this->jobTitles = JobTitle::all();
        $this->uais = Uai::all();
        $this->valido = 0;
    }

    public function store($request)
    {

    }
    public function limpiar()
    {
        $this->resetExcept(['isOpened']);
        $this->mount();

    }

    public function validar()
    {

        $this->valido = 2;
        $this->validate();
        $this->valido = 1;
    }

    public function save()
    {



        $code = $this->phone_code;
        $number = $this->phone_number;
        $this->phone = "$code$number";


      
        $photo = $this->photo->storeAs('public', "$this->p00.jpg");
        $photo = explode("/", $photo);


        Employee::create([
            'personal_id' => $this->personal_id,
            'p00' => $this->p00,
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'first_surname' => $this->first_surname,
            'second_surname' => $this->second_surname,
            'phone' => $this->phone,
            'email_cantv' => $this->email_cantv,
            'gmail' => $this->gmail,
            'profile_photo' => $photo[1],
            'job_title_id' => $this->job_title,
            'uai_id' => $this->uai,
        ]);



        return $this->redirect(route('employee.index'));
    }

    public function render()
    {
        return view('livewire.employee.registerForm');
    }

    public function resetComponent()
    {
        $this->reset(['isOpened', 'test']);
    }
}
