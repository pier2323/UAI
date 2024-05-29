<?php

namespace Database\Seeders;

use App\Models\JobTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = 
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

        foreach($names as $name)
        {
            $cargo = new JobTitle();
            $cargo->name = $name;
            $cargo->save();
        }
    }
}
