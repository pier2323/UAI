<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $usersToPush = [
            [
                'name' => 'geferson',
                'email' => 'geferson.job@gmail.com',
                'password' => '12345678',
            ],
            [
                'name' => 'pier',
                'email' => 'pier44444@gmail.com',
                'password' => '12345678',
            ],
        ];

        foreach($usersToPush as $userToPush)
        {
            $user = new User();
            $user->name = $userToPush['name'];
            $user->email = $userToPush['email'];
            $user->password = $userToPush['password'];
            $user->save();
        }
    }
}