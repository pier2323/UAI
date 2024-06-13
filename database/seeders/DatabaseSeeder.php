<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\AuditActivity;
use App\Models\Employee;
use App\Models\HandoverDocument;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // \App\Models\User::factory()->create([
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);
        // $this->call(ActionSeeder::class);
        $this->call(JobTitleSeeder::class);
        $this->call(DepartamentSeeder::class);
        $this->call(UaiSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(EmployeeOutgoingSeeder::class);
        $this->call(EmployeeIncomingSeeder::class);
        $this->call(TypeAuditSeeder::class);
        $this->call(UserSeeder::class);

        // utilizando la factory para crear x numero de filas

        // AuditActivity::factory(count: 5)->create();
        // HandoverDocument::factory(count: 5)->create();
    }
}
