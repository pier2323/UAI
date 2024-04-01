<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = 
        [
            'administrador de soporte', // 0
            'auditor I', // 1
            'auditor II', // 2
            'lider', // 3
            'especialista', // 4
            'consultor', // 5
            'coordinador', // 6
            'gerente', // 7
            'gerente general', // 8
            'conductor', // 9
            'asesor', // 10
            'abogado', // 11
        ];

        foreach($nombres as $nombre)
        {
            $cargo = new Cargo();
            $cargo->nombre = $nombre;
            $cargo->save();
        }
    }
}
