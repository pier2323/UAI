<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use Doctrine\Inflector\Rules\Word;
use Laravel\Prompts\SearchPrompt;
use Livewire\Component;

class Show extends Component
{
    public $auditActivity;
    public $employees = [];

    public $incoming =[];

    public $outgoing =[];

    public function mount($id)
    {
        $relations = ['employee', 'typeAudit', 'handoverDocument', 'uai'];
        $this->auditActivity = AuditActivity::with($relations)->findOrFail($id);
        $this->employees = \App\Models\Employee::all();
        $this->incoming = \App\Models\EmployeeIncoming::all();
        $this->outgoing  = \App\Models\EmployeeOutgoing::all();

       
    }
    
    

    public function requeriDocumen(){
        $code = $this->auditActivity->code;   
        $template = new \PhpOffice\PhpWord\TemplateProcessor(documentTemplate:'requerimientoTemplate.docx');
        $template->setValue( search:'code',replace:" $code ");
        $template->setValue( search:'unidad_entrega',replace:'Cas');
        $template->setValue( search:'unidad_adcripta',replace:'Gerencia de Control Posteriro');
        $template->setValue( search:'articulo',replace:'el');
        $template->setValue( search:'nombre_saliente',replace:'pier');
        $template->setValue( search:'cedula_saliente',replace:'1234567');
        $template->setValue( search:'fecha_subcripcion',replace:'12/06/2024');
        $template->setValue( search:'fecha_requerimiento',replace:'14/12/2024');
        $template->setValue( search:'fecha_cese',replace:'25/04/2024');
        $template->setValue( search:'fecha_designacion',replace:'Cas');
        


        $Temfile =tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $template->saveAs($Temfile);
       
        return response()->download($Temfile,name:'Requerimiento.docx')->deleteFileAfterSend(shouldDelete:true);

     }   
    public function render()
    {
        return view('livewire.handover.show');
    }
}
