<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;

class CalendarCalculator extends Component
{
    public $resultDate;

    public function __construct($startDate)
    {
        $this->resultDate = $this->calculateBusinessDate($startDate, 120);
    }

    public function calculateBusinessDate($startDate, $daysToAdd)
    {
        // Convierte la fecha de inicio a un objeto Carbon
        $start = Carbon::createFromFormat('d-m-Y', $startDate);
        $holidays = ['2024-01-01', '2024-12-25']; // Agrega aquí tus días feriados

        $addedDays = 0;

        while ($addedDays < $daysToAdd) {
            $start->addDay();

            // Verifica si es sábado, domingo o un día feriado
            if ($start->isWeekend() || in_array($start->toDateString(), $holidays)) {
                continue;
            }

            $addedDays++;
        }

        return $start->toDateString();
    }

    public function render()
    {
        return view('components.calendar-calculator');
    }
}