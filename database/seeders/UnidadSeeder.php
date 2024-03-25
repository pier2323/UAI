<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidadesToPush = [
            // * PRESIDENCIA
            [
                'nombre' => 'presidencia', 
                'nivel' => 1, 
            ],[
                'nombre' => 'gerencia general seguridad integral', 
                'nivel' => 3, 
            ],[
                'nombre' => 'oficina de proyectos estrategicos', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general para el fortalecimiento del poder popular', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general consultoría jurídica', 
                'nivel' => 3, 
            ],
            

            // * VICEPRESIDENCIA DE GESTION INTERNA
            [ 
                'nombre' => 'vicepresidencia de gestión interna',
                'nivel' => 2, 
            ],[
                'nombre' => 'gerencia recaudación y pagos', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general gestión humana', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general finanzas', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general procura', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general comunicaciones asuntos públicos', 
                'nivel' => 3, 
            ],
            

            // * VICEPRESIDENCIA DE PRESTACIÓN DE SERVICIOS
            [ 
                'nombre' => 'vicepresidencia de prestación de servicios', 
                'nivel' => 2, 
            ],[
                'nombre' => 'gerencia de cobranzas y reclamos', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general de mercadeo corporativo', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general operadores de telecomunicaciones', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general mercados masivos', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia arquitectura e ingeniería de soluciones y desarrollo tic', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general empresas e instituciones privadas', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general instituciones públicas', 
                'nivel' => 3, 
            ],
            

            // * VICEPRESIDENCIA EJECUTIVA
            [ 
                'nombre' => 'vicepresidencia ejecutiva', 
                'nivel' => 2, 
            ],[
                'nombre' => 'gerencia gestión y articulación región', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general de seguimiento y control integral de la gestión', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general planificación', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general servicios y logística', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general gestión de flota', 
                'nivel' => 3, 
            ],

            // * VICEPRESIDENCIA DE TECNOLOGÍA E INFRAESTRUCTURA
            [
                'nombre' => 'vicepresidencia de tecnología e infraestructura', 
                'nivel' => 2, 
            ],[
                'nombre' => 'gerencia soporte administrativo', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general sistemas', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general tecnología y operaciones', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general operaciones centralizadas', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general proyectos mayores', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general energía y climatización', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general infraestructura', 
                'nivel' => 3, 
            ],[
                'nombre' => 'gerencia general planificación tecnológica', 
                'nivel' => 3, 
            ]
        ];

        foreach($unidadesToPush as $unidadToPush)
        {
            $unidad = new Unidad();
            $unidad->nombre = $unidadToPush['nombre'];
            $unidad->nivel = $unidadToPush['nivel'];
            $unidad->save();
        }
    }
}
