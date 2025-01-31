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
            // ? 2024 
            '2024-01-01', // Año Nuevo
            '2024-02-12', // Carnaval
            '2024-02-13', // Carnaval
            '2024-03-27', // dias santos
            '2024-03-28', // dias santos
            '2024-03-29', // dias santos
            '2024-04-19', // Declaración de la Independencia
            '2024-05-01', // Día del Trabajador
            '2024-06-24', // Batalla de Carabobo
            '2024-07-05', // Dia de la Independencia
            '2024-10-12', // dia de la raza
            '2024-12-24', // vispera de navida 
            '2024-12-25', // Navidad
            '2024-12-31', // fin de año 
            '2024-07-05' , // Día de la Independencia

            // ? 2025 
            '2025-01-01', // Año Nuevo
            '2025-03-03', // Carnaval
            '2025-03-04', // Carnaval
            '2025-04-16', // dias santos
            '2025-04-17', // dias santos
            '2025-04-18', // dias santos
            '2025-04-19', // Declaración de la Independencia
            '2025-05-01', // Día del Trabajador
            '2025-06-24', // Batalla de Carabobo
            '2025-07-05', // Dia de la Independencia
            '2025-10-12', // dia de la raza
            '2025-12-24', // vispera de navida 
            '2025-12-25', // Navidad
            '2025-12-31', // fin de año 
            '2025-07-05' , // Día de la Independencia

            // ? 2026 
            '2026-01-01', // Año Nuevo
            '2026-02-16', // Carnaval
            '2026-02-17', // Carnaval
            '2026-04-01', // dias santos
            '2026-04-02', // dias santos
            '2026-04-03', // dias santos
            '2026-04-19', // Declaración de la Independencia
            '2026-05-01', // Día del Trabajador
            '2026-06-24', // Batalla de Carabobo
            '2026-07-05', // Dia de la Independencia
            '2026-10-12', // dia de la raza
            '2026-12-24', // vispera de navida 
            '2026-12-25', // Navidad
            '2026-12-31', // fin de año 
            '2026-07-05' , // Día de la Independencia
        ];

        foreach($dates as $date)
        {
            $day = new NotWorkingDays();
            $day->day = $date;
            $day->save();
        }
    }
}
