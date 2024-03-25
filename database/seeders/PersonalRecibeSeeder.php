<?php

namespace Database\Seeders;

use App\Models\PersonalRecibe as PersonalRecibe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalRecibeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personalEntrega = [
            [
                'primer_nombre' => 'Pedro',
                'segundo_nombre' => 'Jose',
                'primer_apellido' => 'Rangel',
                'segundo_apellido' => 'Salazar',
                'gmail' => 'ramonrangel01@gmail.com',
                'email_cantv' => 'rrange01@cantv.com.ve',
                'telefono' => '04125637548',
                'p00' => '154976',
                'cedula' => '23465345',
                'cargo_id' => 1
            ],

            [
                'primer_nombre' => 'pier',
                'segundo_nombre' => 'luigi',
                'primer_apellido' => 'bolech',
                'segundo_apellido' => 'diaz',
                'gmail' => 'pier44444gmail.com',
                'email_cantv' => 'pbolec0@cantv.com.ve',
                'telefono' => '04242295529',
                'p00' => '156373',
                'cedula' => '12345678',
                'cargo_id' => 1
            ]
        ];

        foreach ($personalEntrega as $personal) {
            $persona = new PersonalRecibe();

            $persona->primer_nombre = $personal['primer_nombre'];
            $persona->segundo_nombre = $personal['segundo_nombre'];
            $persona->primer_apellido = $personal['primer_apellido'];
            $persona->segundo_apellido = $personal['segundo_apellido'];
            $persona->gmail = $personal['gmail'];
            $persona->email_cantv = $personal['email_cantv'];
            $persona->telefono = $personal['telefono'];
            $persona->p00 = $personal['p00'];
            $persona->cedula = $personal['cedula'];
            $persona->cargo_id = $personal['cargo_id'];
            $persona->save();
        }
    }
}
