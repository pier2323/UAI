<?php

namespace Database\Seeders;

use App\Models\PersonalUai as PersonalUai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalUaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personalUAI = 
        [
            [
                'cedula' => '28563229', 
                'primer_nombre' => 'geferson', 
                'segundo_nombre' => 'leonaiker', 
                'primer_apellido' => 'moreno', 
                'segundo_apellido' => 'palacios', 
                'telefono' => '04129915401', 
                'p00' => '156373', 
                'gmail' => 'geferson.job@gmail.com', 
                'email_cantv' => 'gmoren002@cantv.com.ve', 
                'cargo_id' => 1, 
                'uai_id' => 1,
                'user_id' => 1, 
            ],[
                'cedula' => '12345678', 
                'primer_nombre' => 'pier', 
                'segundo_nombre' => 'luigi', 
                'primer_apellido' => 'bolech', 
                'segundo_apellido' => 'diaz', 
                'telefono' => '04242295529', 
                'p00' => '156374', 
                'gmail' => 'pier44444@gmail.com', 
                'email_cantv' => 'pbolec@cantv.com.ve', 
                'cargo_id' => 1, 
                'uai_id' => 1, 
                'user_id' => 2, 
            ]
        ];

        
        foreach($personalUAI as $personal)
        {
            $personalUai = new PersonalUai();
            $personalUai->cedula = $personal['cedula'];
            $personalUai->primer_nombre = $personal['primer_nombre'];
            $personalUai->segundo_nombre = $personal['segundo_nombre'];
            $personalUai->primer_apellido = $personal['primer_apellido'];
            $personalUai->segundo_apellido = $personal['segundo_apellido'];
            $personalUai->telefono = $personal['telefono'];
            $personalUai->p00 = $personal['p00'];
            $personalUai->gmail = $personal['gmail'];
            $personalUai->email_cantv = $personal['email_cantv'];
            $personalUai->cargo_id = $personal['cargo_id'];
            $personalUai->uai_id = $personal['uai_id'];
            $personalUai->user_id = $personal['user_id'];
            $personalUai->save();
        }
    }
}
