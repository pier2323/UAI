<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\Employees;
use App\Services\CedulaExcelService;
use App\Traits\ModelPropertyMapper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Show extends Component
{
    use ModelPropertyMapper;
    const PATH_DIRECTORY = 'templateDocument'; 
    public Designation $designation;
    public $auditActivity;
    public $employees = [];

    private array $auditors = [];
    private $auditorsCollection;
    public $incoming = [];


    public $outgoing = [];

    public function mount(int $auditActivity)
    {
        $this->auditActivity = auditActivity::with(['designation' , 'acreditation', 'handoverDocument' => ['employeeOutgoing', 'employeeIncoming'], 'employee'])->where('public_id' ,$auditActivity)->first();
        //dd($this->auditActivity);
        $this->incoming = \App\Models\EmployeeIncoming::all();
        $this->outgoing = \App\Models\EmployeeOutgoing::all();
        
    }
    


    
    public function requeriDocumen(): BinaryFileResponse     
    {
        $requerimientoDocument = new RequeriDocumen($this->auditActivity);
        return $requerimientoDocument->download();
    }

    public function programaDocumen(): BinaryFileResponse
    {
        $programaDocument = new ProgramaDocumen($this->auditActivity);
        return $programaDocument->download();
    }

    public function InformeDocumen()
    {
        $informeDocument = new informeAuditor($this->auditActivity);
        return  $informeDocument->download();
    }
    /* 
     PRUEVAsubir archivo y visulizarlo   */
     
    public function render()
    {
        return view('livewire.handover.show');
    }

    static function getTemplate(string $nameDocument): string
    {
        $documentWithPath = self::PATH_DIRECTORY . "/$nameDocument";
        
        if (!Storage::fileExists($documentWithPath)) {
            dd("no se encontro el document: $documentWithPath");
        }

        return Storage::path(self::PATH_DIRECTORY . "\\$nameDocument");
    }

    public function downloadWorkingCedula()
    {
        $document = new CedulaExcelService();
        $document->downloadExcel();
        dd('downloadWorkingCedula');
    }
    
    
}
