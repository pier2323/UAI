<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\AuditActivity;
use App\Services\WorkingPaper;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;



class Calendar extends Component
{
    
    
    public $auditActivity;
    public $auditActivityWith;
    public $employees = [];
    public $diasRestantes;
    public $nonBusinessDays = [];
    public $mensajeExceso; // Mensaje para indicar exceso de días
    public $diasExcedidos; // Nueva propiedad para almacenar los días excedidos
    
    private array $auditors = [];
    private $auditorsCollection;
    public $incoming = [];
    public $outgoing = [];
    
    public $startDate;
    public $endDate;
    /**
     * Create a new component instance.
     */
    public function __construct()
    
    {
       
      
    }

    public function mount(int $auditActivity)
{
    $this->auditActivity = AuditActivity::with(['designation', 'acreditation', 'handoverDocument' => ['employeeOutgoing', 'employeeIncoming'], 'employee'])
        ->where('public_id', $auditActivity)
        ->first();

       $fechaFin = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->delivery_uai));
    // Establecer la fecha de inicio a la fecha de suscripción más un día
}
   
public function show()
{
    // Obtener la fecha de inicio desde la consulta
    $subscriptionDate = $this->auditActivity->handoverDocument->subscription; // Esto debería ser un string en formato 'Y-m-d'

    // Convertir la fecha de inicio a un objeto Carbon
    $startDate = Carbon::parse($subscriptionDate);
    
    // Calcular la fecha de fin (120 días después)
    $endDate = $startDate->copy()->addDays(120);

    return view('welcome', [
        'startDate' => $startDate->format('d-m-Y'), // Formato 'd-m-Y' para la vista
        'endDate' => $endDate->format('d-m-Y') // Formato 'd-m-Y' para la vista
    ]);
}
    public function render(): View|Closure|string
    {
        return view('components.calendar');
    }
}
