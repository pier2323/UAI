<?php

namespace Database\Seeders;

use App\Models\TipoAuditoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoAuditoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoAuditoria = 
        [
            ['nombre' => 'acta de entrega', 'codigo' => 'ae'],
            ['nombre' => 'auditoria de cumplimiento', 'codigo' => 'ac'],
            ['nombre' => 'auditoria financiera', 'codigo' => 'af'],
            ['nombre' => 'auditoria de inspeccion', 'codigo' => 'ains'],
            ['nombre' => 'auditoria de inventario', 'codigo' => 'ainv'],
            ['nombre' => 'auditoria de gestion', 'codigo' => 'ag'],
            ['nombre' => 'auditoria de seguimiento', 'codigo' => 'ase'],
            ['nombre' => 'auditoria de sistemas', 'codigo' => 'asi'],
            ['nombre' => 'examen de la cuenta', 'codigo' => 'ec'],
            ['nombre' => 'auditoria de proyeto', 'codigo' => 'ap'],
            ['nombre' => 'auditoria de operativa', 'codigo' => 'ao']
        ];

        foreach($tipoAuditoria as $tipo)
        {
            $tipoAuditoria = new TipoAuditoria();
            $tipoAuditoria->nombre = $tipo['nombre'];
            $tipoAuditoria->codigo = $tipo['codigo'];
            $tipoAuditoria->save();
        }
    }
}
