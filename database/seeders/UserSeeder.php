<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersonalUai;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = '12345678';
        foreach(PersonalUai::all() as $personal)
        {
            $user = new User();
            $user->name = $personal->primer_nombre;
            $user->email = $personal->email_cantv;
            $user->password = $password;
            $user->personal_uai_id = $personal->id;
            $user->save();
        }
    }
}