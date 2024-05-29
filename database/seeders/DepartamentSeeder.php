<?php

namespace Database\Seeders;

use App\Models\Departament;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidadesToPush = [
            // * PRESIDENCIA
            [
                'name' => 'presidencia', 
                'level' => 1, 
            ],[
                'name' => 'gerencia general seguridad integral', 
                'level' => 3, 
            ],[
                'name' => 'oficina de proyectos estrategicos', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general para el fortalecimiento del poder popular', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general consultoría jurídica', 
                'level' => 3, 
            ],
            

            // * VICEPRESIDENCIA DE GESTION INTERNA
            [ 
                'name' => 'vicepresidencia de gestión interna',
                'level' => 2, 
            ],[
                'name' => 'gerencia recaudación y pagos', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general gestión humana', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general finanzas', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general procura', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general comunicaciones asuntos públicos', 
                'level' => 3, 
            ],
            

            // * VICEPRESIDENCIA DE PRESTACIÓN DE SERVICIOS
            [ 
                'name' => 'vicepresidencia de prestación de servicios', 
                'level' => 2, 
            ],[
                'name' => 'gerencia de cobranzas y reclamos', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general de mercadeo corporativo', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general operadores de telecomunicaciones', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general mercados masivos', 
                'level' => 3, 
            ],[
                'name' => 'gerencia arquitectura e ingeniería de soluciones y desarrollo tic', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general empresas e instituciones privadas', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general instituciones públicas', 
                'level' => 3, 
            ],
            

            // * VICEPRESIDENCIA EJECUTIVA
            [ 
                'name' => 'vicepresidencia ejecutiva', 
                'level' => 2, 
            ],[
                'name' => 'gerencia gestión y articulación región', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general de seguimiento y control integral de la gestión', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general planificación', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general servicios y logística', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general gestión de flota', 
                'level' => 3, 
            ],

            // * VICEPRESIDENCIA DE TECNOLOGÍA E INFRAESTRUCTURA
            [
                'name' => 'vicepresidencia de tecnología e infraestructura', 
                'level' => 2, 
            ],[
                'name' => 'gerencia soporte administrativo', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general sistemas', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general tecnología y operaciones', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general operaciones centralizadas', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general proyectos mayores', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general energía y climatización', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general infraestructura', 
                'level' => 3, 
            ],[
                'name' => 'gerencia general planificación tecnológica', 
                'level' => 3, 
            ]
        ];

        foreach($unidadesToPush as $unidadToPush)
        {
            $unidad = new Departament();
            $unidad->name = $unidadToPush['name'];
            $unidad->level = $unidadToPush['level'];
            $unidad->save();
        }
    }
}
