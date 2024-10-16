<?php

namespace App\Http\Livewire\Handover;


use App\Models\AuditActivity;
use App\Services\WorkingPaper;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
    
 /*    use ModelPropertyMapper;

    private string $planning_start,$planning_end,$execution_start,$execution_end,$preliminary_start,$preliminary_end,$download_start,$download_end,$definitive_start,$definitive_end;
    private const NAME_TEMPLATE = 'programaTemplate.docx';
    private array $auditors = [];
    private const NAME_DOCUMENT ='programa de trabajo.docx';
    public WorkingPaper $document;

    /* public function __construct(
        private readonly AuditActivity $auditActivity, 
        public readonly ?string $nameDocument = null,
        public readonly ?Carbon $date = null,
    ){
        $unidadEntrega = $this->auditActivity->objective; // Obtener el valor real de la unidad de entrega
        $code = '2024-067'; // Obtener el valor real del código
        $nameDocument = str_replace(['{unidad_entrega}', '{code}'], [$unidadEntrega, $code], self::NAME_DOCUMENT);
        $nameDocument = preg_replace('/[^\w\s]/u', '', str_replace(['{unidad_entrega}', '{code}'], [$unidadEntrega, $code], self::NAME_DOCUMENT));
        
        $nameDocument = $nameDocument . '.doc';
        $this->document = new WorkingPaper (
            templateFile: WorkingPaper::getTemplate(self::NAME_TEMPLATE), 
            nameDocument: $nameDocument,
            date: $date ?? now()->locale('es_ES'),
        );
    }
     */ 
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
        // $resultado = $this->auditActivity->preliminary_days+ 10 +$this->auditActivity->definitive_days;
        $code = $this->auditActivity->handoverDocument->audit_activity_id;
  
        $this->setMapperProperities();
   // Supongamos que estas son tus variables iniciales
        $fecha_subcripcion = '10/05/2024';
        // Extraer el año con la base de datos asi 
        //$anio = substr($this->planning_end, 6, 4);

           // Extraer el año con datos estaticos 
           $anio = substr($fecha_subcripcion, 6, 4);
        $this->document->data = [
            //'code' => $this->auditActivity->code,
            'fecha_progrma' => now()->format('d/m/Y'),
            'unidad_entrega' => 'Gerencia General Operadores de Telecomunicaciones ',
            'unidad_adcripta' => 'Vicepresidencia presidencia de Prestación de Servicio',
            'articulo' => 'ciudadana',
            'periodo_saliente' => '04/10/2017 hasta el 12/08/2024',
            'nombre_saliente' => 'Ingebor Susana Herrera Poleo',
            'cedula_saliente' => '14.486.839',
            'cargo_saliente' => 'Gerencia General de Operadores de Telecomunicaciones',
            'Fecha_acreditacion' => '05/09/2024',
            'fecha_subcripcion' =>   $fecha_subcripcion,
            'nu_acreditacion' => "UAI\\GCP\\DES-COM 2024-068",   //"UAI\\GCP\\DES\\-COM $code",
            'dia_planificacion' =>"12",
            'desde_plan' => "05/09/2024", //$this->planning_start,
            'hasta_plan' =>   "20/09/2024",// $this->planning_end,
            'dia_ejecucion' => "20 ", //$this->auditActivity->execution_days,
            'desde_ejec' => "23/09/2024", //$this->execution_start,
            'hasta_ejec' =>"18/10/2024", // $this->execution_end,
           'resultado' =>  "20",// $resultado
            'desde_r' => "21/10/2024", //$this->preliminary_start,
            'hasta_r' => "15/11/2024",// $this->definitive_end,
            'dia_preliminar' =>"5",  //$this->auditActivity->preliminary_days,
            'desde_p' => "21/10/2024", //$this->preliminary_start,
            'hasta_p' => "25/10/2024",// $this->preliminary_end,
            'desde_desc' => "28/10/2024", //$this->download_start,
            'hasta_desc' => "08/11/2024",// $this->download_end,
            'dia_definitivo' =>"5",  //$this->auditActivity->definitive_days,
            'desde_d' => "11/11/2024",// $this->definitive_start,
            'hasta_d' =>"15/11/2024", // $this->definitive_end,
            'auditores_designados'=> "Silvia Vargas O /Ana Ivone Rojas ",  //=>$this->getAuditorsString(),
             'año'=>$anio,

        ];
        
    }
    

    private function setAuditor(Collection $auditors): void
    {
       foreach ($auditors as $auditor) {
            $jobTitle = $auditor->pivot->role;
            array_push($this->auditors, "$auditor->first_name $auditor->first_surname $auditor->second_surname / $jobTitle");
        }
    }

   private function getAuditorsString(): string
   {
        return implode(
            separator: ", ", 
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
    
