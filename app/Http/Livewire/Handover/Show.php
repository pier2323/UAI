<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use Livewire\Component;

class Show extends Component
{
    public $auditActivity;
    public $employees = [];

    public $incoming = [];

    public $outgoing = [];

    public function mount($id)
    {
        $relations = ['employee', 'typeAudit', 'handoverDocument', 'uai'];
        $this->auditActivity = AuditActivity::with($relations)->findOrFail($id);
        $this->employees = \App\Models\Employee::all();
        $this->incoming = \App\Models\EmployeeIncoming::all();
        $this->outgoing = \App\Models\EmployeeOutgoing::all();

    }

    public function requeriDocumen()
    {
        $code = $this->auditActivity->code;
        $template = new \PhpOffice\PhpWord\TemplateProcessor(documentTemplate: 'requerimientoTemplate.docx');
        $template->setValue(search: 'code', replace: " $code ");
        $template->setValue(search: 'unidad_entrega', replace: 'Cas');
        $template->setValue(search: 'unidad_adcripta', replace: 'Gerencia de Control Posteriro');
        $template->setValue(search: 'articulo', replace: 'el');
        $template->setValue(search: 'nombre_saliente', replace: 'pier');
        $template->setValue(search: 'cedula_saliente', replace: '1234567');
        $template->setValue(search: 'fecha_subcripcion', replace: '12/06/2024');
        $template->setValue(search: 'fecha_requerimiento', replace: '14/12/2024');
        $template->setValue(search: 'fecha_cese', replace: '25/04/2024');
        $template->setValue(search: 'fecha_designacion', replace: 'Cas');

        $Temfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $template->saveAs($Temfile);

        return response()->download($Temfile, name: 'Requerimiento.docx')->deleteFileAfterSend(shouldDelete: true);
    }

    public function programaDocumen()
    {

        $code = $this->auditActivity->code;
        $template = new \PhpOffice\PhpWord\TemplateProcessor(documentTemplate: 'programaTemplate.docx');
        $template->setValue(search: 'code', replace: " $code ");
        $template->setValue(search: 'fecha_progrma', replace: '14/06/2015');
        $template->setValue(search: 'unidad_entrega', replace: 'Cas');
        $template->setValue(search: 'unidad_adcripta', replace: 'Gerencia de Control Posteriro');
        $template->setValue(search: 'articulo', replace: 'el');
        $template->setValue(search: 'periodo_saliente', replace: '14/10/2024');
        $template->setValue(search: 'nu_acreditacion', replace: '0005');
        $template->setValue(search: 'nombre_saliente', replace: 'pier');
        $template->setValue(search: 'cedula_saliente', replace: '1234567');
        $template->setValue(search: 'cargo_saliente', replace: '1234567');
        $template->setValue(search: 'Fecha_acreditacion', replace: '12/06/2024');
        $template->setValue(search: 'fecha_subcripcion', replace: '12/06/2024');
        $template->setValue(search: 'dia_planificacion', replace: '14/05/2004');
        $template->setValue(search: 'desde_plan', replace: '14/05/2004');
        $template->setValue(search: 'hasta_plan', replace: '14/05/2004');
        $template->setValue(search: 'dia_ejecucion', replace: '14/05/2004');
        $template->setValue(search: 'desde_ejec', replace: '14/05/2055');
        $template->setValue(search: 'hasta_ejec', replace: '14/05/2056');
        $template->setValue(search: 'Resultado', replace: '15/05/2056');
        $template->setValue(search: 'desde_r', replace: '18/05/2056');
        $template->setValue(search: 'hasta_r', replace: '15/05/2056');
        $template->setValue(search: 'dia_preliminar', replace: '25/10/2024');
        $template->setValue(search: 'desde_p', replace: '28/10/2024');
        $template->setValue(search: 'hasta_p', replace: '29/10/2024');
        $template->setValue(search: 'desde_desc', replace: '30/10/2024');
        $template->setValue(search: 'hasta_desc', replace: '32/10/2024');
        $template->setValue(search: 'dia_definitivo', replace: '10/11/2024');
        $template->setValue(search: 'desde_d', replace: '33/10/2024');
        $template->setValue(search: 'hasta_d', replace: '35/10/2024');
        $template->setValue(search: 'personal_des', replace: 'pierluigi ,jose');
        $template->setValue(search: 'resultado', replace: 'hola');
       

      
        $Temfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $template->saveAs($Temfile);

        return response()->download($Temfile, name: 'programa de trabajo.docx')->deleteFileAfterSend(shouldDelete: true);
    }

    public function render()
    {
        return view('livewire.handover.show');
    }
}
