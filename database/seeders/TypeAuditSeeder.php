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
            ['name' => 'Acta de Entrega', 'code' => 'ae'],                 // * 1 uno   
            ['name' => 'Auditoría de Cumplimiento', 'code' => 'ac'],       // * 2 dos   
            ['name' => 'Auditoría Financiera', 'code' => 'af'],            // * 3 tres  
            ['name' => 'Auditoría de Inspección', 'code' => 'ains'],       // * 4 cuatro
            ['name' => 'Auditoría de Inventario', 'code' => 'ainv'],       // * 5 cinco 
            ['name' => 'Auditoría de Gestion', 'code' => 'ag'],            // * 6 seis  
            ['name' => 'Auditoría de Seguimiento', 'code' => 'as'],        // * 7 siete 
            ['name' => 'Auditoría de Sistemas', 'code' => 'asi'],          // * 8 ocho  
            ['name' => 'Examen de la Cuenta', 'code' => 'ec'],             // * 9 nueve 
            ['name' => 'Auditoría de Proyeto', 'code' => 'ap'],            // * 10 diez 
            ['name' => 'Auditoría de Operativa', 'code' => 'ao']           // * 11 once 
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
