<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalEntrega extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personalEntrega = 
        [
            [
                'Ramon',
                'Jose',
                'Rangel',
                'Salazar',
                'ramonrangel01@gmail.com',
                'rrange01@cantv.com.ve',
                '04125637548',
                '154976',
                '23465345',
                'cargo_id'
            ],
            [
                'primer_nombre',
                'segundo_nombre',
                'primer_apellido',
                'segundo_apellido',
                'gmail',
                'emai_cantv',
                'telefono',
                'p00',
                'cedula',
                'cargo_id'
            ],
            [
                'primer_nombre',
                'segundo_nombre',
                'primer_apellido',
                'segundo_apellido',
                'gmail',
                'emai_cantv',
                'telefono',
                'p00',
                'cedula',
                'cargo_id'
            ],

        ];

        foreach($nombres as $nombre)
        {
            $cargo = new Cargo();
            $cargo->nombre = $nombre;
            $cargo->save();
        }
    }
}
