<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Uai;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegisterForm extends Component
{
    use WithFileUploads;
    public  $p00, $first_name, $second_name, $first_surname, $second_surname, $phone, $email_cantv, $gmail, $photo, $job_title ,$uai ,$personal_id
    ; 

    public $isOpened = false;
    public $test;
    public $jobTitles;
    public $uais;

    public function mount()
    {
        $this->jobTitles = JobTitle::all();
        $this->uais = Uai::all();
    }

    public function save()
    {
        
        $this->personal_id = explode("-", $this->personal_id);
        $photo = $this->photo->storeAs('public', "$this->p00.jpg");
        $photo = explode("/",$photo);
        Employee::create([
            
            'personal_id' => $this->personal_id[1],
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
