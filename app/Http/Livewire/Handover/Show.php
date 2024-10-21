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
    public $diasRestantes;
    public $nonBusinessDays = [];
    public $mensajeExceso; // Mensaje para indicar exceso de días
    public $diasExcedidos; // Nueva propiedad para almacenar los días excedidos
    
    private array $auditors = [];
    private $auditorsCollection;
    public $incoming = [];
    public $outgoing = [];
    
    // Fecha de inicio para el cálculo
    public $fechaInicio;
    private $feriados = [
        '2024' => [
            '01/01', // Año nuevo
            '01/06', // Día de Reyes
            '03/19', // Día de San José
            '04/09', // Jueves Santo
            '04/10', // Viernes Santo
            '05/01', // Día del Trabajador
            '07/20', // Día de la Independencia
            '08/07', // Día de la Batalla de Boyacá
            '12/08', // Día de la Inmaculada Concepción
            '12/25', // Navidad
        ],
        '2025' => [
            '01/01', // Año nuevo
            '01/06', // Día de Reyes
            '03/19', // Día de San José
            '04/17', // Jueves Santo
            '04/18', // Viernes Santo
            '05/01', // Día del Trabajador
            '06/19', // Corpus Christi
            '07/20', // Día de la Independencia
            '08/07', // Día de la Batalla de Boyacá
            '12/08', // Día de la Inmaculada Concepción
            '12/25', // Navidad
        ],
    ];
    
    private function isFeriado($date)
{
    $year = $date->format('Y');
    $formattedDate = $date->format('d/m'); // Cambiar a formato dd/mm

    return isset($this->feriados[$year]) && in_array($formattedDate, $this->feriados[$year]);
}
    public function mount(int $auditActivity)
    {
        $this->auditActivity = AuditActivity::with(['designation', 'acreditation', 'handoverDocument' => ['employeeOutgoing', 'employeeIncoming'], 'employee'])
            ->where('public_id', $auditActivity)
            ->first();

        // Establecer la fecha de inicio a una fecha fija (10 de octubre de 2024)
        $this->fechaInicio = \Carbon\Carbon::parse($this->auditActivity->handoverDocument->subscription); 
        $this->incoming = \App\Models\EmployeeIncoming::all();
        $this->outgoing = \App\Models\EmployeeOutgoing::all();

        // Calcular los días restantes y los días no hábiles
        $this->diasRestantes = $this->calculateDiasRestantes();
        $this->nonBusinessDays = $this->calculateNonBusinessDays();
    }

    // Método para calcular los días restantes (excluyendo sábados y domingos)
    private function calculateDiasRestantes()
    {
        $fechaHoy = \Carbon\Carbon::now(); // Obtener la fecha actual
        $diasRestantes = 0;
    
        if ($this->fechaInicio > $fechaHoy) {
            $this->diasExcedidos = 0;
            $this->mensajeExceso = "La fecha de inicio es futura. No se han contabilizado días.";
            return 0;
        }
    
        for ($date = $this->fechaInicio->copy(); $date <= $fechaHoy; $date->addDay()) {
            if ($date->isWeekday() && !$this->isFeriado($date)) {
                $diasRestantes++;
            }
        }
    
        if ($diasRestantes > 120) {
            $this->diasExcedidos = $diasRestantes - 120;
            $this->mensajeExceso = "Se está pasando de los 120 días por $this->diasExcedidos días.";
        } else {
            $this->diasExcedidos = 0;
            $this->mensajeExceso = null;
        }
    
        return $diasRestantes;
    }
    // Método para calcular los días no hábiles (sábados y domingos)
    private function calculateNonBusinessDays()
    {
        $fechaHoy = \Carbon\Carbon::now(); // Obtener la fecha actual
        $nonBusinessDays = [];

        // Recorrer las fechas desde la fecha de inicio hasta hoy
        for ($date = $this->fechaInicio->copy(); $date <= $fechaHoy; $date->addDay()) {
            if (!$date->isWeekday()) {
                $nonBusinessDays[] = $date->format('d/m/Y'); // Formatear la fecha
            }
        }

        return $nonBusinessDays; // Devuelve un array de días no hábiles
    }

    // Métodos para descargar documentos...
    
    public function render()
    {
        return view('livewire.handover.showHandover', [
            'mensajeExceso' => $this->mensajeExceso, // Pasar el mensaje a la vista
            'diasExcedidos' => $this->diasExcedidos, // Pasar los días excedidos a la vista
        ]);
    }

    // Otros métodos...
}