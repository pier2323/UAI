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
        $departamentos = 
        [
            [
                'nombre' => 'Gerencia General', 
                'nivel' => 1, // 0
            ],
            [
                'nombre' => 'Control Posterior', 
                'nivel' => 2, // 1
            ],
            [
                'nombre' => 'Determinacion de Responsabilidades', 
                'nivel' => 2, // 2
            ],
            [
                'nombre' => 'Auditoria de Sitemas', 
                'nivel' => 3, // 3
            ],
            [
                'nombre' => 'Auditoria de Gestion', 
                'nivel' => 3, // 4
            ],
            [
                'nombre' => 'Auditoria de Seguimiento', 
                'nivel' => 3, // 5
            ],
            [
                'nombre' => 'Auditoria Financiera', 
                'nivel' => 3, // 6
            ],
            [
                'nombre' => 'Potestad Investigativa', 
                'nivel' => 3, // 7
            ],
            [
                'nombre' => 'Planificacion y Control', 
                'nivel' => 3, // 8
            ]
        ];

        foreach($departamentos as $departamento)
        {
            $uai = new Uai();
            $uai->nombre = $departamento['nombre'];
            $uai->nivel = $departamento['nivel'];
            $uai->save();
        }
    }
}
