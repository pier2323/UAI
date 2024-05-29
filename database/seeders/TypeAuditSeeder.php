<?php

namespace Database\Seeders;

use App\Models\TypeAudit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeAuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typesAudit = 
        [
            ['name' => 'acta de entrega', 'code' => 'ae'],
            ['name' => 'auditoria de cumplimiento', 'code' => 'ac'],
            ['name' => 'auditoria financiera', 'code' => 'af'],
            ['name' => 'auditoria de inspeccion', 'code' => 'ains'],
            ['name' => 'auditoria de inventario', 'code' => 'ainv'],
            ['name' => 'auditoria de gestion', 'code' => 'ag'],
            ['name' => 'auditoria de seguimiento', 'code' => 'ase'],
            ['name' => 'auditoria de sistemas', 'code' => 'asi'],
            ['name' => 'examen de la cuenta', 'code' => 'ec'],
            ['name' => 'auditoria de proyeto', 'code' => 'ap'],
            ['name' => 'auditoria de operativa', 'code' => 'ao']
        ];

        foreach($typesAudit as $typeAudit)
        {
            $typeAuditModel = new TypeAudit();
            $typeAuditModel->name = $typeAudit['name'];
            $typeAuditModel->code = $typeAudit['code'];
            $typeAuditModel->save();
        }
    }
}
