<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use \PhpOffice\PhpSpreadsheet\IOFactory;

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
        $template->setValue(search: 'fecha_designacion', replace: '25/45/225');

        $Temfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $template->saveAs($Temfile);

        return response()->download($Temfile, name: 'Requerimiento.docx')->deleteFileAfterSend(shouldDelete: true);
    }

    public function programaDocumen()
    {

        $code = $this->auditActivity->code ();
        $fecha_planificacion = $this->auditActivity->planning_start;
        $hasta_plan= $this->auditActivity->planning_end;

        dd([
            'code' => '',
            'fecha_progrma' => '',
            'unidad_entrega' => '',
            'unidad_adcripta' => '',
            'articulo' => '',
            'periodo_saliente' => '',
            'nu_acreditacion' => '',
            'nombre_saliente' => '',
            'cedula_saliente' => '',
            'cargo_saliente' => '',
            'Fecha_acreditacion' => '',
            'fecha_subcripcion' => '',
            'dia_planificacion' => $fecha_planificacion,
            'desde_plan' => '',
            'hasta_plan' => '',
            'dia_ejecucion' => '',
            'desde_ejec' => '',
            'hasta_ejec' => '',
            'Resultado' => '',
            'desde_r' => '',
            'hasta_r' => '',
            'dia_preliminar' => '',
            'desde_p' => '',
            'hasta_p' => '',
            'desde_desc' => '',
            'hasta_desc' => '',
            'dia_definitivo' => '',
            'desde_d' => '',
            'hasta_d' => '',
            'personal_des' => '',
            'resultado' => '',
        ]);



        $template = new \PhpOffice\PhpWord\TemplateProcessor(documentTemplate: 'programaTemplate.docx');
        $template->setValue(search: 'code', replace: " $code ");

        $template->setValue(search: 'fecha_progrma', replace: '14/06/2015');
        $template->setValue(search: 'unidad_entrega', replace: 'Cas');
        $template->setValue(search: 'unidad_adcripta', replace: 'Gerencia de Control Posteriro');
        $template->setValue(search: 'articulo', replace: 'ciudadano');
        /* revisar el periodo */
        /* y tambien que tome la fecha de la computadora */
        $template->setValue(search: 'periodo_saliente', replace: '14/10/2024');
        $template->setValue(search: 'nu_acreditacion', replace: '0005');
        $template->setValue(search: 'nombre_saliente', replace: 'pier');
        $template->setValue(search: 'cedula_saliente', replace: '1234567');
        $template->setValue(search: 'cargo_saliente', replace: '1234567');
        $template->setValue(search: 'Fecha_acreditacion', replace: '12/06/2024');
        $template->setValue(search: 'fecha_subcripcion', replace: '12/06/2024');
        $template->setValue(search: 'dia_planificacion', replace: "$fecha_planificacion");
        $template->setValue(search: 'desde_plan', replace: '14/05/2004');
        $template->setValue(search: 'hasta_plan', replace: "$hasta_plan");
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


    public function CedulaDocumen()
    {


        $code = $this->auditActivity->code;
        $unidad_entrega = "gerencia control posterior";
        $unidad_adscrita = "UAI";
        $periodo_saliente_desde = "20/23/2020";
        $periodo_saliente_hasta = "10/05/2020";
        $nombre_saliente = "pier";
        $cedula_saliente = "12345678";
        $auditor_a = "geferson";
        $auditor_b = "jose";
        $nombre_recibe = "jose";
        $cedula_recibe = "12345678";
        $periodo_desde = '16/08/2022';
        $periodo_hasta = '20/15/2025';
        $cargo = "auditro";

        $spreadsheet = IOFactory::load('cedulaTemplate.xlsm');
        $hoja1 = $spreadsheet->getSheetByName('ATRIBUTOS');
        $hoja1->setCellValue('A5', "ACTUACIÓN FISCAL SOBRE LA VERIFICACIÓN DE LA SINCERIDAD Y EXACTITUD DEL CONTENIDO DEL ACTA DE ENTREGA DE LA $unidad_entrega ADSCRITA A LA $unidad_adscrita CORRESPONDIENTE AL SERVIDOR(A) PÚBLICO(A) SALIENTE CIUDADANO(A) $nombre_saliente, TITULAR DE LA CÉDULA DE IDENTIDAD NRO. $cedula_saliente, DURANTE EL PERIODO DE GESTIÓN DEL $periodo_desde AL $periodo_hasta");

        $hoja2 = $spreadsheet->getSheetByName('CEDULA');
        $hoja2->setCellValue('B10', "$unidad_entrega");
        $hoja2->setCellValue('D10', "$unidad_adscrita");
        $hoja2->setCellValue('K10', "$nombre_saliente");
        $hoja2->setCellValue('K11', "$cedula_saliente");
        $hoja2->setCellValue('p10', "$nombre_recibe");
        $hoja2->setCellValue('p11', "$cedula_recibe");
        $hoja2->setCellValue('T11', "$periodo_saliente_desde");
        $hoja2->setCellValue('B10', "$periodo_saliente_hasta");
        $hoja2->setCellValue('C23', "   $auditor_a");
        $hoja2->setCellValue('O23', "$auditor_b");


        $hoja3 = $spreadsheet->getSheetByName('HALLAZGOS');
        $hoja3->setCellValue('D7', "$unidad_entrega adscrita a la $unidad_adscrita");
        $hoja3->setCellValue('B5', "  Actuación $periodo_desde a la $periodo_hasta");
        $hoja3->setCellValue('C9', "De la evaluación practicada al contenido del Acta de Entrega de la $unidad_entrega , correspondiente a la servidor(a) público(a) saliente, $nombre_saliente, titular de la cédula de identidad Nro.$cedula_saliente; se determinó lo siguiente:");
        $hoja3->setCellValue('C44', "$auditor_a");
        $hoja3->setCellValue('E44', "$auditor_b");


        $hoja5 = $spreadsheet->getSheetByName('desglose de hallazgos');
        $hoja5->setCellValue('D16', "$cargo");
        $hoja5->setCellValue('D1', "$code");


        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $Temfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');

        $writer->save($Temfile);
        return response()->download($Temfile, name: 'Cedula.xlsx')->deleteFileAfterSend(shouldDelete: true);
        










    }

    public function InformeDocumen()
    {
        $code = $this->auditActivity->code;
        $template = new \PhpOffice\PhpWord\TemplateProcessor(documentTemplate: 'informeAuditorTemplate.docx');
        $template->setValue(search: 'fecha_acta', replace: '14/06/2015');
        $template->setValue(search: 'fecha_progrma', replace: '14/06/2015');
        $template->setValue(search: 'code', replace: "$code");
        $template->setValue(search: 'periodo_saliente', replace: '15/05/2025');
        $template->setValue(search: 'unidad_adcripta', replace: 'Gerencia de Control Posteriro');
        $template->setValue(search: 'nombre_saliente', replace: 'pedro');
        $template->setValue(search: 'cedula_saliente', replace: '1234567');
        $template->setValue(search: 'periodo_gestion', replace: '15/05/2025');
        $template->setValue(search: 'periodo_gestiona', replace: '15/05/2025');
        $template->setValue(search: 'fecha', replace: '19/05/2025');
        $template->setValue(search: 'articulo', replace: 'ciudadano');
        $template->setValue(search: ' codigo_desgisnacion', replace: 'codigo de la actuacion');
        $template->setValue(search: 'fecha_designacion', replace: '15/06/2022');
        $template->setValue(search: 'fecha_subcripcion', replace: '12/06/2024');
        $template->setValue(search: 'periodo_desde', replace: '14/06/2015');
        $template->setValue(search: 'periodo_hasta', replace: '14/06/2015');
        $template->setValue(search: 'code', replace: " $code ");
        $template->setValue(search: 'auditor_a', replace: 'pier');
        $template->setValue(search: 'auditor_b', replace: 'gaferson');
        $template->setValue(search: 'articulo', replace: 'ciudadano');
        $template->setValue(search: 'unidad_entrega', replace: 'Cas');
        $template->setValue(search: 'nombre_recibe', replace: 'pedro');
        $template->setValue(search: 'cedula_recibe', replace: '1234567');
        $Temfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $template->saveAs($Temfile);

        return response()->download($Temfile, name: 'Informe del Auditor .docx')->deleteFileAfterSend(shouldDelete: true);
    }

    /* 
     PRUEVAsubir archivo y visulizarlo   */



        
    public function render()
    {
        return view('livewire.handover.show');
    }

}
