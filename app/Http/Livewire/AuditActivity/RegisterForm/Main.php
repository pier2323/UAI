<?php

namespace App\Http\Livewire\AuditActivity\RegisterForm;

use App\Models\AuditActivity,
    App\Models\HandoverDocument as HandoverDocumentModel,
    App\Models\EmployeeIncoming,
    App\Models\EmployeeOutgoing,
    App\Models\JobTitle,
    App\Models\TypeAudit,
    App\Models\Departament,
    Exception,
    Livewire\Component;

class Main extends Component
{
    public $typeAudit = 'acta de entrega';
    public Outgoing $outgoing;
    public Incoming $incoming;
    public HandoverDocument $handoverDocument;
    
    public $open, $errorMessage, $job_titles, $departaments;

    public function render()
    {
        return view('livewire.audit-activity.register-form.main');
    }

    public function mount()
    {
        $this->open = false;
        $this->job_titles = JobTitle::all();
        $this->departaments = Departament::all();
    }

    public function save()
    {
        $this->handoverDocument->validate();
        $this->outgoing->validate();
        $this->incoming->validate();

        // ? AuditActivity 
        $auditActivity = new AuditActivity();
        $auditActivity->type_audit_id = TypeAudit::where('name', $this->typeAudit)->first()->id;
        $auditActivity->save();

        // ? Outgoing 
        $code = $this->outgoing->phone_code; // todo 0412 
        $number = $this->outgoing->phone_number; // todo 9915401 
        $this->outgoing->phone = "$code$number"; // todo 04129915401 

        $outgoing = EmployeeOutgoing::create($this->outgoing->only([
            'p00', 
            'first_name', 
            'second_name', 
            'first_surname', 
            'second_surname', 
            'phone',
            'email_cantv', 
            'gmail', 
            'personal_id', 

            // ? relations 
            'job_title_id', 
            'departament_id', 
        ]));


        // ? Incoming 
        $code = $this->incoming->phone_code; // todo 0412 
        $number = $this->incoming->phone_number; // todo 9915401 
        $this->incoming->phone = "$code$number"; // todo 04129915401 

        $incoming = EmployeeIncoming::create($this->incoming->only([
            'p00', 
            'first_name', 
            'second_name', 
            'first_surname', 
            'second_surname', 
            'phone',
            'email_cantv', 
            'gmail', 
            'personal_id', 
            'job_title_id', 
        ]));

        // ? HandoverDocument 
        $this->handoverDocument->toFormatDate();
        $this->handoverDocument->employee_outgoing_id = $outgoing->id;
        $this->handoverDocument->employee_incoming_id = $incoming->id;
        $this->handoverDocument->audit_activity_id = $auditActivity->id;

        $handoverDocument = HandoverDocumentModel::create($this->handoverDocument->only([
            'name', 
            'target', 
            'cease', 
            'subscription', 
            'delivery_uai', 
            'employee_outgoing_id', 
            'employee_incoming_id', 
            'audit_activity_id', 
        ]));

        session()->flash(key: 'status', value: 'La nueva Acta de Entrega ha sido registrada correctamente');
        $this->restartProperties();
        $this->refresh();
    }

    public function queryError(String $option)
    {
        try {
            $this->{$option}->validateOnly(
                field: 'query', 
                rules: ["query" => [
                    'required',
                    'numeric',
                    "exists:employee_$option,p00"
                    ]
                ], 
                messages: [
                    'query.required' => 'el campo no puede estar vacio',
                    'query.numeric' => 'el p00 tiene que contener solo numeros',
                    'query.exists' => 'el p00 ingresado no se encontro en la base de datos',
                ]
            );            
        } catch (Exception $error) {
            $this->{$option}->errorMessage = $error->getMessage();
            $this->dispatch("query_error_$option");
            throw $error;
        }
        $this->{$option}->mount();
    }

    public function restartProperties() 
    {
        $this->open = false;
        $this->incoming->reset();
        $this->outgoing->reset();
        $this->handoverDocument->reset();
    }
            
    // ? HandoverDocument 
    public function restartHandoverDocument() 
    {
        $this->handoverDocument->reset();
    }
 
    public function verifyHandoverDocument() 
    {
        $this->handoverDocument->verified = 2;
        $this->handoverDocument->validate();
        $this->handoverDocument->verified = 1;
    }
        
    // ? Outgoing 
    public function queryOutgoing ()
    {
        $this->queryError('outgoing');
    }

    public function restartOutgoing() 
    {
        $this->outgoing->reset();
    }
 
    public function verifyOutgoing() 
    {
        $this->outgoing->verified = 2;
        $this->outgoing->validate();
        $this->outgoing->verified = 1;
    }

    // ? Incoming 
    public function queryIncoming ()
    {
        $this->queryError('incoming');
    }

    public function restartIncoming() 
    {
        $this->incoming->reset();
    }
    
    public function verifyIncoming() 
    {
        $this->incoming->verified = 2;
        $this->incoming->validate();
        $this->incoming->verified = 1;
    }
}
