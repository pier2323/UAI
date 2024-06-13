<?php

namespace App\Http\Livewire\AuditActivity;

use Livewire\Component;

class RegisterForm extends Component
{
    public $isOpened = false;
    public $id = "registerFormAuditActivity";
    public function render()
    {
        return view('livewire.audit-activity.register-form');
    }
}
