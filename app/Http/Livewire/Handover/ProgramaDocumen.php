<?php

namespace App\Http\Livewire\Handover;

use App\Livewire\SaveData;
use App\Models\AuditActivity;
use App\Services\WorkingPaper;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use League\CommonMark\Node\Block\Document;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use PhpOffice\PhpWord\TemplateProcessor;

final class ProgramaDocumen
{
    
    use ModelPropertyMapper;
    private string $planning_start,$planning_end,$execution_start,$execution_end,$preliminary_start,$preliminary_end,$download_start,$download_end,$definitive_start,$definitive_end;
    private const NAME_TEMPLATE = 'programaTemplate.docx';
    private array $auditors = [];
    private const NAME_DOCUMENT = 'programa de trabajo.docx';
    public WorkingPaper $document;

    public function __construct(
        private readonly AuditActivity $auditActivity, 
        public readonly ?string $nameDocument = null,
        public readonly ?Carbon $date = null,
    ){
        $this->document = new WorkingPaper (
            templateFile: WorkingPaper::getTemplate(self::NAME_TEMPLATE), 
            nameDocument: $nameDocument ?? self::NAME_DOCUMENT,
            date: $date ?? now()->locale('es_ES'),
        );
    }
    
    public function download(): BinaryFileResponse
    {

        // todo save all auditors 
        $this->setAuditor($this->auditActivity->employee()->orderBy('role', 'desc')->get());

        

        // todo save all data 
        $this->setData();

        // todo generate pathDocument 
        $this->document->generatePathDocument();

        // todo generate document 
        $this->document->create();
        
        return $this->document->getPathDocumentToDownload();
    }
    
  
    private function setData(): void
    {
        $resultado = $this->auditActivity->preliminary_days+ 10 +$this->auditActivity->definitive_days;
        $code = $this->auditActivity->code;
        $this->setMapperProperities();
        // Supongamos que estas son tus variables iniciales
        $fecha_subcripcion = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->subscription));
        $periodo_inicial =date('d-m-Y', strtotime($this->auditActivity->handoverDocument->start));
        $periodo_cease = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->cease));
        // Extraer el año con datos estaticos 
        $employeeOutgoing = $this->auditActivity->handoverDocument->employeeOutgoing;
        $full_name_Outgoing = "$employeeOutgoing->first_name " .(isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '')."$employeeOutgoing->first_surname" .(isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '');
        $anio = substr($fecha_subcripcion, 6, 4);


     

        //dd( $periodo_cease );
        $this->document->data = [

            'code' => $this->auditActivity->code,
            'fecha_progrma' => now()->format('d/m/Y'),
            'unidad_entrega' => $this->auditActivity->handoverDocument->departament,
            'unidad_adcripta' =>  $this->auditActivity->handoverDocument->departament_affiliation,
            'articulo' => 'ciudadana',
            'periodo_saliente' => "$periodo_inicial hasta el $periodo_cease ",
            'nombre_saliente' =>   $full_name_Outgoing,
            'cedula_saliente' => $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id,
            'cargo_saliente' => $this->auditActivity->handoverDocument->job_title,
         

            'Fecha_acreditacion' =>  date_format($this->auditActivity->designation[0]->date_release, 'd-m-Y'),
            'fecha_subcripcion' =>   $fecha_subcripcion,
            'nu_acreditacion' => "UAI\\GCP\\DES\\ACRE $code",
            'dia_planificacion' => $this->auditActivity->planning_days,
            'desde_plan' => $this->planning_start,
            'hasta_plan' =>    $this->planning_end,
            'dia_ejecucion' => $this->auditActivity->execution_days,
            'desde_ejec' => $this->execution_start,
            'hasta_ejec' => $this->execution_end,
           'resultado' =>   $resultado,
            'desde_r' => $this->preliminary_start,
            'hasta_r' => $this->definitive_end,
            'dia_preliminar' => $this->auditActivity->preliminary_days,
            'desde_p' => $this->preliminary_start,
            'hasta_p' => $this->preliminary_end,
            'desde_desc' => $this->download_start,
            'hasta_desc' => $this->download_end,
            'dia_definitivo' =>$this->auditActivity->definitive_days,
            'desde_d' => $this->definitive_start,
            'hasta_d' =>$this->definitive_end,
            'auditores_designados' =>$this->getAuditorsString(),
             'año'=>$anio,


            ];
        }
    private function setAuditor(Collection $auditors): void
    {
       foreach ($auditors as $auditor) {
           
            array_push($this->auditors, "$auditor->first_name $auditor->first_surname $auditor->second_surname ");
        }
    }

   private function getAuditorsString(): string
   {
        return implode(
            separator: "/ ", 
            array: $this->auditors
        );
   }


    private function setMapperProperities(): void {
        $properties = [
            'planning_start',
            'planning_end',
            'execution_start',
            'execution_end',
            'preliminary_start',
            'preliminary_end',
            'download_start',
            'download_end',
            'definitive_start',
            'definitive_end',
        ];
    
        $this->mapModelPropertiesPier(
            model: $this->auditActivity, 
            properties: $properties,
        );
    }
       
    }
    
