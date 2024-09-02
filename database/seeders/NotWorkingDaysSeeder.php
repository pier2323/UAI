<?php

namespace Database\Seeders;

use App\Models\NotWorkingDays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotWorkingDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dates = [
            '2024-01-01', // Año Nuevo
            '2024-04-19', // Declaración de la Independencia
            '2024-05-01', // Día del Trabajador
            '2024-06-24', // Batalla de Carabobo
            '2024-12-31', // fin de año 
            '2024-07-05'  // Día de la Independencia
        ];

        foreach($dates as $date)
        {
            $day = new NotWorkingDays();
            $day->day = $date;
            $day->save();
        }
    }
}
