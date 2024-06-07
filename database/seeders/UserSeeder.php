<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = '12345678';
        foreach(Employee::all() as $employee)
        {
            $user = new User();
            $user->name = $employee->first_name;
            $user->email = $employee->email_cantv;
            $user->password = $password;
            $user->employee_id = $employee->id;
            $user->save();
        }
    }
}