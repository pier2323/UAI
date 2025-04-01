<?php

namespace App\Form\Employee;

use App\Models\Employee;
use App\Traits\ModelPropertyMapper;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Form;

class EmployeeForm extends Form
{
    use ModelPropertyMapper;
    use WithFileUploads;
    
    public string $phone;

    #[Validate('numeric|required|unique:employee,p00|min:5', as: 'p00')]
    public $p00;
    #[Validate('required|max:500', as: 'Primer Nombre')]
    public $first_name;
    #[Validate('max:500', as: 'Segundo Nombre')]
    public $second_name;
    #[Validate('alpha|required|max:500', as: 'Primer Apellido ')]
    public $first_surname;
    #[Validate('max:500', as: 'Segundo Apellido')]
    public $second_surname;
    #[validate('', as: 'Correo Corporativo')]
    public $email_cantv;
    #[validate('required|email', as: 'Correo Personal')]
    public $gmail;
    #[Validate('required|image|mimes:jpg,png,|max:4096 ', as: 'Foto')]
    public $profile_photo;
    #[validate('required', as: 'cargo')]
    public $job_title;
    #[validate('required', as: 'Coordinación o Gerencia ')]
    public $uai;
    #[validate('required|numeric|min:8|unique:employee,personal_id', as: ' Numero de cedula')]
    public $personal_id;

    // #[Rule(['required', 'string', 'max:255'])]
    public string $phone_code;
    
    #[validate('required|numeric|min:9 |unique:employee,phone', as: ' Numero de Telefono')]
    public string $phone_number;

    public bool $verified = false;

    public function load(Employee $model)
    {
        $this->mapModelProperties($model, $this->except($this->exceptProperties()));

        $this->phone_code = substr($this->phone, 0, 4);
        $this->phone_number = substr($this->phone, 4,7);
        $this->job_title = $model->jobTitle->name;
        $this->uai = $model->Uai->name;
    }

    public function save()
    {
        $code = $this->phone_code;
        $number = $this->phone_number;
        $this->phone = "$code$number";
        $photo = $this->profile_photo->storeAs('public/employees/profile-photo', "$this->p00.jpg");
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
            'profile_photo' => "$this->p00.jpg",
            'job_title_id' => $this->job_title,
            'uai_id' => $this->uai,
        ]);
    }

    public function verify(): void
    {
        $this->verified = false;
        $this->validate();
        $this->verified = true;
    }
    
    public function getProperties(): array
    {
        // $this->validate();
        return $this->except($this->exceptProperties());
    }

    private function exceptProperties(): array
    {
        return ['phone_code', 'phone_number', 'job_title', 'uai'];
    }
}
