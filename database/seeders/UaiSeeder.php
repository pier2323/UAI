<?php

namespace Database\Seeders;

use App\Models\Uai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departaments = 
        [
            [
                'name' => 'Despacho', 
                'level' => 1, // * 1 
            ],
            [
                'name' => 'Control Posterior', 
                'level' => 2, // * 2 
            ],
            [
                'name' => 'Determinación de Responsabilidades', 
                'level' => 2, // * 3 
            ],
            [
                'name' => 'Auditoría de Sistemas', 
                'level' => 3, // * 4 
            ],
            [
                'name' => 'Auditoría de Gestión', 
                'level' => 3, // * 5 
            ],
            [
                'name' => 'Auditoría de Seguimiento', 
                'level' => 3, // * 6 
            ],
            [
                'name' => 'Auditoría Financiera',
                'level' => 3, // * 7 
            ],
            [
                'name' => 'Potestad Investigativa', 
                'level' => 3, // * 8 
            ],
            [
                'name' => 'Planificación y Control', 
                'level' => 3, // * 9 
            ]
        ];

        foreach($departaments as $departament)
        {
            $uai = new Uai();
            $uai->name = $departament['name'];
            $uai->level = $departament['level'];
            $uai->save();
        }
    }
}
