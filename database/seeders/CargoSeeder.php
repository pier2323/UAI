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
            'administrador de soporte', 
            'auditor I',
            'auditor II', 
            'lider', 
            'especialista', 
            'consultor', 
            'coordinador', 
            'gerente'
        ];

        foreach($nombres as $nombre)
        {
            $cargo = new Cargo();
            $cargo->nombre = $nombre;
            $cargo->save();
        }
    }
}
