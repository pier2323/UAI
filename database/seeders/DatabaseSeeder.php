<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ActaEntrega;
use Illuminate\Database\Seeder;
use \App\Models\ActuacionFiscal;

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
        $this->call(CargoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UnidadSeeder::class);
        $this->call(UaiSeeder::class);
        $this->call(PersonalUaiSeeder::class);
        $this->call(PersonalEntregaSeeder::class);
        $this->call(PersonalRecibeSeeder::class);
        $this->call(TipoAuditoriaSeeder::class);

        // utilizando la factory para crear x numero de filas
        $filasActuacion = 20;
        $filasActa = 2;
        ActuacionFiscal::factory($filasActuacion)->create();
        ActaEntrega::factory($filasActa)->create();
    }
}
