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
            ['name' => 'acta de entrega', 'code' => 'ae'],                 // * 1 uno   
            ['name' => 'auditoria de cumplimiento', 'code' => 'ac'],       // * 2 dos   
            ['name' => 'auditoria financiera', 'code' => 'af'],            // * 3 tres  
            ['name' => 'auditoria de inspeccion', 'code' => 'ains'],       // * 4 cuatro
            ['name' => 'auditoria de inventario', 'code' => 'ainv'],       // * 5 cinco 
            ['name' => 'auditoria de gestion', 'code' => 'ag'],            // * 6 seis  
            ['name' => 'auditoria de seguimiento', 'code' => 'as'],        // * 7 siete 
            ['name' => 'auditoria de sistemas', 'code' => 'asi'],          // * 8 ocho  
            ['name' => 'examen de la cuenta', 'code' => 'ec'],             // * 9 nueve 
            ['name' => 'auditoria de proyeto', 'code' => 'ap'],            // * 10 diez 
            ['name' => 'auditoria de operativa', 'code' => 'ao']           // * 11 once 
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
