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
            'administrador de soporte', // 1
            'auditor I', // 2
            'auditor II', // 3
            'lider', // 4
            'especialista', // 5
            'consultor I', // 6
            'coordinador', // 7
            'gerente', // 8
            'auditor interno', // 9
            'conductor', // 10
            'asesor', // 11
            'abogado', // 12
            'analista', // 12
            'consultor II', // 12
            'mensajero', // 12
        ];

        foreach($nombres as $nombre)
        {
            $cargo = new Cargo();
            $cargo->nombre = $nombre;
            $cargo->save();
        }
    }
}
