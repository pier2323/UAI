<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\AuditActivity;
use App\Models\Year;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

/**
 *  todo Este componente de Livewire gestiona la visualización y la interacción con los datos de Actuaciones fiscales para un año específico dentro de la aplicación. Permite a los usuarios filtrar y visualizar las Actuaciones Fiscales en función de si están asociadas a un Plan Operativo Anal (POA) o no.
 * @param ?Year $year // ? el modelo que contiene los datos del año fiscal 
 * @param Collection $auditActivityPoa // ? Coleccion Eloquent que tiene los datos del Model AuditActivity filtrados por su columna 'is_poa' con valor true 
 * @param Collection $auditActivityNoPoa // ? Coleccion Eloquent que tiene los datos del Model AuditActivity filtrados por su columna 'is_poa' con valor false 
 */
class Main extends Component
{
    use WithPagination, WithoutUrlPagination;

    public ?Year $year;

    public Collection $auditActivityPoa;
    public Collection $auditActivityNoPoa;

    /**
     * todo carga el año y las colecciones eloquente correspondientes 
     * @return void
     */
    public function mount(): void
    {
        $this->year = Year::get();
        $this->auditActivityPoa = AuditActivity::with([
            'handoverDocument' => [
                'employeeIncoming',
                'employeeOutgoing',
            ],
            'typeAudit',
            'uai',])
            ->where('is_poa', true)
            ->where('year', $this->year?->selected)
            ->orderBy('id', 'asc')
            ->get();

        $this->auditActivityNoPoa = AuditActivity::with([
            'handoverDocument' => [
                'employeeIncoming',
                'employeeOutgoing',
            ],
            'typeAudit',
            'uai',])
            ->where('is_poa', false)
            ->where('year', $this->year?->selected)
            ->get();
    }

    public function refresh(): void
    {
        $this->mount(true);
        $this->dispatch('refresh');
    }

    /**
     * todo muestra la vista correspondiente 
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): \Illuminate\Contracts\View\View
    {
        return View::make('livewire.audit-activity.main');
    }

    /**
     * todo redicciona al ruta auditActivity.show/{public_id} 
     * @param integer $id // ?el public_id de la Actuación fiscal seleccionada
     * @return void
     */
    public function goTo(int $id): void
    {
        $this->redirectRoute('auditActivity.show', ['public_id' => $id], navigate: true);
    }

}
